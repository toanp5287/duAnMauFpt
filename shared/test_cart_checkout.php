<?php
/**
 * Test validation Cart + Checkout (Backend Round 6).
 * Chạy: php shared/test_cart_checkout.php
 */

declare(strict_types=1);

require_once __DIR__ . '/../website/config/Database.php';
require_once __DIR__ . '/Validator.php';

$baseUrl = getenv('WEB_TEST_BASE_URL') ?: 'http://localhost/web-ban-hang/website/public/index.php';
$cookieFile = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'web_cart_test_cookies.txt';
$passed = 0;
$failed = 0;
$skipped = 0;

function cart_test(string $name, callable $fn): void
{
    global $passed, $failed;

    try {
        $fn();
        echo "[PASS] {$name}\n";
        $passed++;
    } catch (Throwable $e) {
        echo "[FAIL] {$name}\n";
        echo "       {$e->getMessage()}\n";
        $failed++;
    }
}

function cart_skip(string $reason): void
{
    global $skipped;
    echo "[SKIP] HTTP tests — {$reason}\n";
    $skipped++;
}

function cart_pdo(): PDO
{
    $pdo = (new Database())->getConnection();
    if (!$pdo instanceof PDO) {
        throw new RuntimeException('Không kết nối database.');
    }

    return $pdo;
}

function cart_url(string $baseUrl, string $controller, string $action, array $query = []): string
{
    $query = array_merge(['controller' => $controller, 'action' => $action], $query);

    return $baseUrl . '?' . http_build_query($query);
}

function cart_request(string $url, array $data = [], string $method = 'POST', ?string $cookieFile = null): string
{
    $ch = curl_init($url);
    $options = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER         => true,
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_TIMEOUT        => 15,
    ];

    if ($cookieFile !== null) {
        $options[CURLOPT_COOKIEJAR] = $cookieFile;
        $options[CURLOPT_COOKIEFILE] = $cookieFile;
    }

    if (strtoupper($method) === 'POST') {
        $options[CURLOPT_POST] = true;
        $options[CURLOPT_POSTFIELDS] = http_build_query($data);
    }

    curl_setopt_array($ch, $options);
    $response = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);

    if ($response === false) {
        throw new RuntimeException('cURL: ' . $err);
    }

    return (string) $response;
}

function cart_body(string $response): string
{
    $parts = preg_split("/\r\n\r\n|\n\n/", $response, 2);

    return $parts[1] ?? $response;
}

function cart_assert_contains(string $haystack, string $needle, string $context): void
{
    if (strpos($haystack, $needle) === false) {
        throw new RuntimeException("Expected \"{$needle}\" — {$context}");
    }
}

function cart_find_user_password(PDO $pdo): array
{
    $row = $pdo->query('SELECT email, password FROM users WHERE role = 0 ORDER BY id ASC LIMIT 1')->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        return ['', ''];
    }

    $candidates = array_filter(array_unique([
        getenv('WEB_TEST_PASSWORD') ?: '',
        'testpass123',
        '12345678',
        'password',
        '123456',
    ]));

    foreach ($candidates as $candidate) {
        if (md5($candidate) === $row['password']) {
            return [$row['email'], $candidate];
        }
    }

    return ['', ''];
}

echo "Cart + Checkout validation tests\n";
echo "Base URL: {$baseUrl}\n\n";

$pdo = cart_pdo();

cart_test('Validator: quantity must be integer', function () {
    $v = Validator::make(['so_luong' => 'abc'], ['so_luong' => 'required|integer|min_value:1'], [
        'so_luong.integer' => 'Số lượng phải là số nguyên.',
    ]);
    if ($v->first('so_luong') !== 'Số lượng phải là số nguyên.') {
        throw new RuntimeException('Integer message mismatch.');
    }
});

cart_test('Validator: quantity must be > 0', function () {
    $v = Validator::make(['so_luong' => '0'], ['so_luong' => 'required|integer|min_value:1'], [
        'so_luong.min_value' => 'Số lượng phải lớn hơn 0.',
    ]);
    if ($v->first('so_luong') !== 'Số lượng phải lớn hơn 0.') {
        throw new RuntimeException('Min quantity message mismatch.');
    }
});

cart_test('Validator: checkout payment method', function () {
    $v = Validator::make(['payment' => 'FAKE'], ['payment' => 'required|in:COD,VNPAY'], [
        'payment.in' => 'Phương thức thanh toán không hợp lệ.',
    ]);
    if ($v->first('payment') !== 'Phương thức thanh toán không hợp lệ.') {
        throw new RuntimeException('Payment message mismatch.');
    }
});

@unlink($cookieFile);
[$email, $password] = cart_find_user_password($pdo);

if ($email === '' || $password === '') {
    cart_skip('đặt WEB_TEST_PASSWORD để chạy test HTTP.');
} else {
    $loginResp = cart_request(cart_url($baseUrl, 'login', 'xu_ly_dang_nhap'), [
        'email'    => $email,
        'password' => $password,
    ], 'POST', $cookieFile);

    if (strpos($loginResp, 'Location:') === false) {
        cart_skip('đăng nhập thất bại.');
    } else {
        $productId = (int) $pdo->query('SELECT id FROM san_pham WHERE so_luong > 0 ORDER BY id ASC LIMIT 1')->fetchColumn();
        $cartItemId = 0;

        if ($productId > 0) {
            cart_request(cart_url($baseUrl, 'chi_tiet', 'them_gio_hang', ['id' => (string) $productId]), [], 'GET', $cookieFile);
            $userId = (int) $pdo->query('SELECT id FROM users WHERE email = ' . $pdo->quote($email))->fetchColumn();
            $cartItemId = (int) $pdo->query(
                "SELECT ghct.id FROM giohang_chi_tiet ghct
                 JOIN giohang gh ON gh.id = ghct.giohang_id
                 WHERE gh.user_id = {$userId} AND ghct.san_pham_id = {$productId}
                 ORDER BY ghct.id DESC LIMIT 1"
            )->fetchColumn();
        }

        if ($cartItemId > 0) {
            cart_test('HTTP update cart: invalid quantity text', function () use ($baseUrl, $cookieFile, $cartItemId) {
                $body = cart_body(cart_request(
                    cart_url($baseUrl, 'shopping_cart', 'updateSoLuong'),
                    ['id' => (string) $cartItemId, 'so_luong' => 'abc'],
                    'POST',
                    $cookieFile
                ));
                $json = json_decode($body, true);
                if (!is_array($json) || ($json['message'] ?? '') !== 'Số lượng phải là số nguyên.') {
                    throw new RuntimeException('Expected integer quantity JSON error.');
                }
            });

            cart_test('HTTP update cart: zero quantity', function () use ($baseUrl, $cookieFile, $cartItemId) {
                $body = cart_body(cart_request(
                    cart_url($baseUrl, 'shopping_cart', 'updateSoLuong'),
                    ['id' => (string) $cartItemId, 'so_luong' => '0'],
                    'POST',
                    $cookieFile
                ));
                $json = json_decode($body, true);
                if (!is_array($json) || ($json['message'] ?? '') !== 'Số lượng phải lớn hơn 0.') {
                    throw new RuntimeException('Expected zero quantity JSON error.');
                }
            });

            cart_test('HTTP delete cart: invalid item id', function () use ($baseUrl, $cookieFile) {
                $body = cart_body(cart_request(
                    cart_url($baseUrl, 'shopping_cart', 'delete_gio_hang', ['id' => '99999999']),
                    [],
                    'GET',
                    $cookieFile
                ));
                cart_assert_contains($body, 'Không tìm thấy sản phẩm trong giỏ hàng.', 'delete missing item');
            });
        }

        if ($productId > 0) {
            cart_request(cart_url($baseUrl, 'buy', 'index', ['id' => (string) $productId]), [], 'GET', $cookieFile);

            cart_test('HTTP checkout: empty fullName shows field error', function () use ($baseUrl, $cookieFile) {
                $body = cart_body(cart_request(cart_url($baseUrl, 'buy', 'by'), [
                    'fullName'   => '',
                    'phone'      => '0901234567',
                    'address'    => '123 Đường Test, Quận 1, TP.HCM',
                    'payment'    => 'COD',
                    'discount'   => '999999999',
                    'totalPrice' => '1',
                ], 'POST', $cookieFile));

                cart_assert_contains($body, 'Họ tên người nhận không được để trống.', 'empty name');
                cart_assert_contains($body, 'id="fullName-error"', 'name error under field');
            });

            cart_test('HTTP checkout: invalid phone', function () use ($baseUrl, $cookieFile) {
                $body = cart_body(cart_request(cart_url($baseUrl, 'buy', 'by'), [
                    'fullName' => 'Nguyễn Test',
                    'phone'    => '123',
                    'address'  => '123 Đường Test, Quận 1, TP.HCM',
                    'payment'  => 'COD',
                ], 'POST', $cookieFile));

                cart_assert_contains($body, 'Số điện thoại không hợp lệ.', 'invalid phone');
                cart_assert_contains($body, 'id="phone-error"', 'phone error under field');
            });

            cart_test('HTTP checkout: invalid payment method', function () use ($baseUrl, $cookieFile) {
                $body = cart_body(cart_request(cart_url($baseUrl, 'buy', 'by'), [
                    'fullName' => 'Nguyễn Test',
                    'phone'    => '0901234567',
                    'address'  => '123 Đường Test, Quận 1, TP.HCM',
                    'payment'  => 'BITCOIN',
                ], 'POST', $cookieFile));

                cart_assert_contains($body, 'Phương thức thanh toán không hợp lệ.', 'invalid payment');
            });
        }

        cart_test('HTTP add to cart: invalid product id', function () use ($baseUrl, $cookieFile) {
            cart_request(cart_url($baseUrl, 'chi_tiet', 'them_gio_hang', ['id' => '99999999']), [], 'GET', $cookieFile);
            $body = cart_body(cart_request(cart_url($baseUrl, 'shopping_cart', 'index'), [], 'GET', $cookieFile));
            cart_assert_contains($body, 'Sản phẩm không tồn tại.', 'invalid product add');
        });
    }
}

echo "\nResult: {$passed} passed, {$failed} failed, {$skipped} skipped\n";
@unlink($cookieFile);

exit($failed > 0 ? 1 : 0);
