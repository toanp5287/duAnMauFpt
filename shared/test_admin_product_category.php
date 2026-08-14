<?php
/**
 * Test validation Product + Category (Backend Round 5).
 * Chạy: php shared/test_admin_product_category.php
 */

declare(strict_types=1);

require_once __DIR__ . '/../website/config/Database.php';
require_once __DIR__ . '/Validator.php';

$baseUrl = getenv('ADMIN_TEST_BASE_URL') ?: 'http://localhost/web-ban-hang/admin/index.php';
$cookieFile = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'admin_test_cookies.txt';
$passed = 0;
$failed = 0;
$skipped = 0;

function admin_test(string $name, callable $fn): void
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

function admin_skip(string $name, string $reason): void
{
    global $skipped;
    echo "[SKIP] {$name} — {$reason}\n";
    $skipped++;
}

function admin_pdo(): PDO
{
    $db = new Database();
    $pdo = $db->getConnection();
    if (!$pdo instanceof PDO) {
        throw new RuntimeException('Không kết nối được database.');
    }

    return $pdo;
}

function admin_url(string $baseUrl, string $controller, string $action, array $query = []): string
{
    $query = array_merge(['controller' => $controller, 'action' => $action], $query);

    return $baseUrl . '?' . http_build_query($query);
}

function admin_request(string $baseUrl, string $controller, string $action, array $data = [], string $method = 'POST', ?string $cookieFile = null, array $query = []): string
{
    $url = admin_url($baseUrl, $controller, $action, $query);
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
        throw new RuntimeException('cURL error: ' . $err);
    }

    return (string) $response;
}

function admin_body(string $response): string
{
    $parts = preg_split("/\r\n\r\n|\n\n/", $response, 2);

    return $parts[1] ?? $response;
}

function admin_assert_contains(string $haystack, string $needle, string $context): void
{
    if (strpos($haystack, $needle) === false) {
        throw new RuntimeException("Expected \"{$needle}\" — {$context}");
    }
}

function admin_find_admin_password(PDO $pdo, string $email): ?string
{
    $candidates = array_filter(array_unique([
        getenv('ADMIN_TEST_PASSWORD') ?: '',
        'admin123',
        '12345678',
        '123456',
        'admin',
        'password',
    ]));

    $stmt = $pdo->prepare('SELECT password FROM users WHERE email = :email AND role = 1 LIMIT 1');
    $stmt->execute([':email' => $email]);
    $hash = $stmt->fetchColumn();

    if (!$hash) {
        return null;
    }

    foreach ($candidates as $candidate) {
        if ($candidate !== '' && md5($candidate) === $hash) {
            return $candidate;
        }
    }

    return null;
}

echo "Admin Product + Category validation tests\n";
echo "Base URL: {$baseUrl}\n\n";

$pdo = admin_pdo();

$categoryId = (int) $pdo->query('SELECT id FROM loai_hang ORDER BY id ASC LIMIT 1')->fetchColumn();
$productId = (int) $pdo->query('SELECT id FROM san_pham ORDER BY id ASC LIMIT 1')->fetchColumn();
$adminEmail = (string) $pdo->query('SELECT email FROM users WHERE role = 1 ORDER BY id ASC LIMIT 1')->fetchColumn();

// --- Validator unit tests (no HTTP) ---

admin_test('Product rules: empty name', function () use ($pdo) {
    $validator = Validator::make([], [
        'ten_san_pham' => 'required|min:2|max:255',
        'gia'          => 'required|numeric|min_value:1',
        'so_luong'     => 'required|integer|min_value:0',
        'loai_hang'    => 'required|integer|exists:loai_hang,id',
    ], [
        'ten_san_pham.required' => 'Tên sản phẩm không được để trống.',
    ], $pdo);

    if (!$validator->fails() || $validator->first('ten_san_pham') !== 'Tên sản phẩm không được để trống.') {
        throw new RuntimeException('Expected empty name error.');
    }
});

admin_test('Product rules: non-numeric price', function () use ($pdo, $categoryId) {
    $validator = Validator::make([
        'ten_san_pham' => 'SP Test',
        'gia'          => 'abc',
        'so_luong'     => '10',
        'loai_hang'    => (string) $categoryId,
    ], [
        'gia' => 'required|numeric|min_value:1',
    ], [
        'gia.numeric' => 'Giá sản phẩm phải là số.',
    ], $pdo);

    if ($validator->first('gia') !== 'Giá sản phẩm phải là số.') {
        throw new RuntimeException('Expected numeric price error.');
    }
});

admin_test('Product rules: zero price', function () use ($pdo) {
    $validator = Validator::make(['gia' => '0'], ['gia' => 'required|numeric|min_value:1'], [
        'gia.min_value' => 'Giá sản phẩm phải lớn hơn 0.',
    ], $pdo);

    if ($validator->first('gia') !== 'Giá sản phẩm phải lớn hơn 0.') {
        throw new RuntimeException('Expected zero price error.');
    }
});

admin_test('Product rules: negative quantity', function () use ($pdo) {
    $validator = Validator::make(['so_luong' => '-1'], ['so_luong' => 'required|integer|min_value:0'], [
        'so_luong.min_value' => 'Số lượng không được nhỏ hơn 0.',
    ], $pdo);

    if ($validator->first('so_luong') !== 'Số lượng không được nhỏ hơn 0.') {
        throw new RuntimeException('Expected negative quantity error.');
    }
});

admin_test('Product rules: non-integer quantity', function () use ($pdo) {
    $validator = Validator::make(['so_luong' => '1.5'], ['so_luong' => 'required|integer|min_value:0'], [
        'so_luong.integer' => 'Số lượng phải là số nguyên.',
    ], $pdo);

    if ($validator->first('so_luong') !== 'Số lượng phải là số nguyên.') {
        throw new RuntimeException('Expected integer quantity error.');
    }
});

admin_test('Product rules: category not exists', function () use ($pdo) {
    $validator = Validator::make(['loai_hang' => '99999999'], ['loai_hang' => 'required|integer|exists:loai_hang,id'], [
        'loai_hang.exists' => 'Danh mục không tồn tại.',
    ], $pdo);

    if ($validator->first('loai_hang') !== 'Danh mục không tồn tại.') {
        throw new RuntimeException('Expected missing category error.');
    }
});

admin_test('Product rules: product id not exists', function () use ($pdo) {
    $validator = Validator::make(['id' => '99999999'], ['id' => 'required|integer|min_value:1|exists:san_pham,id'], [
        'id.exists' => 'Sản phẩm không tồn tại.',
    ], $pdo);

    if ($validator->first('id') !== 'Sản phẩm không tồn tại.') {
        throw new RuntimeException('Expected missing product error.');
    }
});

admin_test('Category rules: empty name', function () use ($pdo) {
    $validator = Validator::make([], ['ten_loai' => 'required|min:2|max:100'], [
        'ten_loai.required' => 'Tên danh mục không được để trống.',
    ], $pdo);

    if ($validator->first('ten_loai') !== 'Tên danh mục không được để trống.') {
        throw new RuntimeException('Expected empty category name error.');
    }
});

// --- HTTP tests (require admin login) ---

if ($adminEmail === '' || $categoryId <= 0) {
    admin_skip('HTTP tests', 'Thiếu admin hoặc danh mục trong database.');
} else {
    @unlink($cookieFile);
    $adminPassword = admin_find_admin_password($pdo, $adminEmail);

    if ($adminPassword === null) {
        admin_skip('HTTP tests', 'Không xác định được mật khẩu admin (đặt ADMIN_TEST_PASSWORD).');
    } else {
        $loginResponse = admin_request($baseUrl, 'auth', 'login', [
            'email'    => $adminEmail,
            'password' => $adminPassword,
        ], 'POST', $cookieFile);

        if (strpos($loginResponse, 'Location: index.php?controller=san_pham&action=index') === false) {
            admin_skip('HTTP tests', 'Đăng nhập admin thất bại.');
        } else {
            admin_test('HTTP Product create: empty name shows field error', function () use ($baseUrl, $cookieFile, $categoryId) {
                $body = admin_body(admin_request($baseUrl, 'san_pham', 'create', [
                    'ten_san_pham' => '',
                    'gia'          => '',
                    'so_luong'     => '',
                    'loai_hang'    => (string) $categoryId,
                ], 'POST', $cookieFile));

                admin_assert_contains($body, 'Tên sản phẩm không được để trống.', 'name error');
                admin_assert_contains($body, 'id="ten_tour-error"', 'error under name field');
                admin_assert_contains($body, 'border-red-600', 'error border');
            });

            admin_test('HTTP Product create: invalid price text', function () use ($baseUrl, $cookieFile, $categoryId) {
                $body = admin_body(admin_request($baseUrl, 'san_pham', 'create', [
                    'ten_san_pham' => 'Sản phẩm test',
                    'gia'          => 'chữ',
                    'so_luong'     => '5',
                    'loai_hang'    => (string) $categoryId,
                ], 'POST', $cookieFile));

                admin_assert_contains($body, 'Giá sản phẩm phải là số.', 'price text error');
                admin_assert_contains($body, 'id="gia-error"', 'error under price field');
            });

            admin_test('HTTP Product create: invalid category id', function () use ($baseUrl, $cookieFile) {
                $body = admin_body(admin_request($baseUrl, 'san_pham', 'create', [
                    'ten_san_pham' => 'Sản phẩm test',
                    'gia'          => '100000',
                    'so_luong'     => '5',
                    'loai_hang'    => '99999999',
                ], 'POST', $cookieFile));

                admin_assert_contains($body, 'Danh mục không tồn tại.', 'missing category');
            });

            admin_test('HTTP Product update: invalid product id', function () use ($baseUrl, $cookieFile, $categoryId) {
                $response = admin_request($baseUrl, 'san_pham', 'update', [], 'GET', $cookieFile);
                $response = admin_request($baseUrl, 'san_pham', 'update', [
                    'id'             => '99999999',
                    'ten_san_pham'   => 'SP',
                    'gia'            => '1000',
                    'so_luong'       => '1',
                    'loai_hang_id'   => (string) $categoryId,
                ], 'POST', $cookieFile);

                admin_assert_contains($response, 'Sản phẩm không tồn tại.', 'invalid product update');
            });

            admin_test('HTTP Category create: empty name', function () use ($baseUrl, $cookieFile) {
                $body = admin_body(admin_request($baseUrl, 'loai_hang', 'create', [
                    'ten_loai' => '',
                ], 'POST', $cookieFile));

                admin_assert_contains($body, 'Tên danh mục không được để trống.', 'empty category');
                admin_assert_contains($body, 'id="ten_loai-error"', 'error under field');
            });

            admin_test('HTTP Category create: duplicate name', function () use ($baseUrl, $cookieFile, $pdo) {
                $existing = (string) $pdo->query('SELECT ten_loai FROM loai_hang ORDER BY id ASC LIMIT 1')->fetchColumn();
                $body = admin_body(admin_request($baseUrl, 'loai_hang', 'create', [
                    'ten_loai' => $existing,
                ], 'POST', $cookieFile));

                admin_assert_contains($body, 'Danh mục này đã tồn tại.', 'duplicate category');
            });

            admin_test('HTTP Category update: invalid id GET', function () use ($baseUrl, $cookieFile) {
                $response = admin_request($baseUrl, 'loai_hang', 'update', [], 'GET', $cookieFile, ['id' => '99999999']);
                admin_assert_contains($response, 'Location: index.php?controller=loai_hang&action=index', 'redirect on bad id');
            });

            if ($productId > 0) {
                admin_test('HTTP Product delete: invalid id redirects', function () use ($baseUrl, $cookieFile) {
                    $response = admin_request($baseUrl, 'san_pham', 'delete', [], 'GET', $cookieFile, ['id' => '99999999']);
                    admin_assert_contains($response, 'Location: index.php?controller=san_pham&action=index', 'redirect');
                });
            }
        }
    }
}

echo "\nResult: {$passed} passed, {$failed} failed, {$skipped} skipped\n";
@unlink($cookieFile);

exit($failed > 0 ? 1 : 0);
