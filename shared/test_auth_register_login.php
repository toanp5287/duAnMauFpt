<?php

/**
 * Test validation Register + Login (Backend Round 4).
 * Chạy: php shared/test_auth_register_login.php
 */

declare(strict_types=1);

$baseUrl = getenv('AUTH_TEST_BASE_URL') ?: 'http://localhost/web-ban-hang/website/public/index.php';
$passed = 0;
$failed = 0;

function auth_test(string $name, callable $fn): void
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

function auth_post(string $baseUrl, string $action, array $data): string
{
    $url = $baseUrl . '?controller=login&action=' . $action;

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => http_build_query($data),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_HEADER         => true,
        CURLOPT_TIMEOUT        => 15,
    ]);

    $response = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);

    if ($response === false) {
        throw new RuntimeException('cURL error: ' . $err);
    }

    return (string) $response;
}

function auth_body(string $response): string
{
    $parts = preg_split("/\r\n\r\n|\n\n/", $response, 2);

    return $parts[1] ?? $response;
}

function auth_assert_contains(string $haystack, string $needle, string $context): void
{
    if (strpos($haystack, $needle) === false) {
        throw new RuntimeException("Expected to find \"{$needle}\" — {$context}");
    }
}

function auth_assert_not_contains(string $haystack, string $needle, string $context): void
{
    if (strpos($haystack, $needle) !== false) {
        throw new RuntimeException("Should NOT contain \"{$needle}\" — {$context}");
    }
}

echo "Auth validation tests\n";
echo "Base URL: {$baseUrl}\n\n";

// --- REGISTER ---

auth_test('Register: submit empty shows field errors', function () use ($baseUrl) {
    $body = auth_body(auth_post($baseUrl, 'xu_ly_dang_ky', []));
    auth_assert_contains($body, 'Họ tên không được để trống.', 'name empty');
    auth_assert_contains($body, 'Email không được để trống.', 'email empty');
    auth_assert_contains($body, 'id="email-error"', 'email error id');
    auth_assert_contains($body, 'aria-invalid="true"', 'aria-invalid on error field');
    auth_assert_contains($body, 'border-red-600', 'error border class');
});

auth_test('Register: invalid email format', function () use ($baseUrl) {
    $body = auth_body(auth_post($baseUrl, 'xu_ly_dang_ky', [
        'name'            => 'Nguyễn Văn A',
        'email'           => 'not-an-email',
        'phone'           => '0901234567',
        'password'        => 'password123',
        'confirmPassword' => 'password123',
    ]));
    auth_assert_contains($body, 'Email không đúng định dạng.', 'bad email');
    auth_assert_contains($body, 'value="Nguyễn Văn A"', 'keep valid name');
    auth_assert_not_contains($body, 'value="password123"', 'no password repopulated');
});

auth_test('Register: password under 6 chars', function () use ($baseUrl) {
    $body = auth_body(auth_post($baseUrl, 'xu_ly_dang_ky', [
        'name'           => 'Nguyễn Văn A',
        'email'          => 'test_' . uniqid() . '@example.com',
        'phone'          => '0901234567',
        'password'       => 'short',
        'confirmPassword' => 'short',
    ]));

    auth_assert_contains(
        $body,
        'Mật khẩu phải có ít nhất 6 ký tự.',
        'short password'
    );
});

auth_test('Register: confirm password mismatch', function () use ($baseUrl) {
    $body = auth_body(auth_post($baseUrl, 'xu_ly_dang_ky', [
        'name'            => 'Nguyễn Văn A',
        'email'           => 'test_' . uniqid() . '@example.com',
        'phone'           => '0901234567',
        'password'        => 'password123',
        'confirmPassword' => 'password999',
    ]));
    auth_assert_contains($body, 'Mật khẩu xác nhận không khớp.', 'confirm mismatch');
});

auth_test('Register: invalid phone', function () use ($baseUrl) {
    $body = auth_body(auth_post($baseUrl, 'xu_ly_dang_ky', [
        'name'            => 'Nguyễn Văn A',
        'email'           => 'test_' . uniqid() . '@example.com',
        'phone'           => '12345',
        'password'        => 'password123',
        'confirmPassword' => 'password123',
    ]));
    auth_assert_contains($body, 'Số điện thoại không hợp lệ.', 'bad phone');
});

auth_test('Register: invalid name format', function () use ($baseUrl) {
    $body = auth_body(auth_post($baseUrl, 'xu_ly_dang_ky', [
        'name'            => '123456',
        'email'           => 'test_' . uniqid() . '@example.com',
        'phone'           => '0901234567',
        'password'        => 'password123',
        'confirmPassword' => 'password123',
    ]));
    auth_assert_contains($body, 'Họ tên phải đúng định dạng.', 'bad name');
});

// --- LOGIN ---

auth_test('Login: empty email and password', function () use ($baseUrl) {
    $body = auth_body(auth_post($baseUrl, 'xu_ly_dang_nhap', [
        'email'    => '',
        'password' => '',
    ]));
    auth_assert_contains($body, 'Vui lòng nhập email.', 'empty email');
    auth_assert_contains($body, 'Vui lòng nhập mật khẩu.', 'empty password');
    auth_assert_contains($body, 'id="loginEmail-error"', 'email error under field');
});

auth_test('Login: invalid email format', function () use ($baseUrl) {
    $body = auth_body(auth_post($baseUrl, 'xu_ly_dang_nhap', [
        'email'    => 'bad-email',
        'password' => 'password123',
    ]));
    auth_assert_contains($body, 'Email không đúng định dạng.', 'bad email format');
});

auth_test('Login: wrong credentials generic message', function () use ($baseUrl) {
    $body = auth_body(auth_post($baseUrl, 'xu_ly_dang_nhap', [
        'email'    => 'nonexistent_' . uniqid() . '@example.com',
        'password' => 'wrongpassword123',
    ]));
    auth_assert_contains($body, 'Email hoặc mật khẩu không chính xác.', 'generic auth error');
    auth_assert_not_contains($body, 'Email không tồn tại.', 'no email leak');
    auth_assert_not_contains($body, 'Mật khẩu sai.', 'no password leak');
    auth_assert_contains($body, 'id="login-auth-error"', 'auth error id');
});

$testEmail = 'round4_test_' . uniqid() . '@example.com';
$testPassword = 'testpass123';

auth_test('Register: valid registration redirects to login', function () use ($baseUrl, $testEmail, $testPassword) {
    $response = auth_post($baseUrl, 'xu_ly_dang_ky', [
        'name'            => 'Nguyễn Văn Test',
        'email'           => $testEmail,
        'phone'           => '0901234567',
        'password'        => $testPassword,
        'confirmPassword' => $testPassword,
    ]);
    auth_assert_contains($response, 'Location: index.php?controller=login&action=index', 'redirect after register');
});

auth_test('Register: duplicate email', function () use ($baseUrl, $testEmail, $testPassword) {
    $body = auth_body(auth_post($baseUrl, 'xu_ly_dang_ky', [
        'name'            => 'Nguyễn Văn Test',
        'email'           => $testEmail,
        'phone'           => '0901234567',
        'password'        => $testPassword,
        'confirmPassword' => $testPassword,
    ]));
    auth_assert_contains($body, 'Email này đã được đăng ký.', 'duplicate email');
    auth_assert_contains($body, 'id="email-error"', 'email error under field');
});

auth_test('Login: valid credentials redirect to shop', function () use ($baseUrl, $testEmail, $testPassword) {
    $response = auth_post($baseUrl, 'xu_ly_dang_nhap', [
        'email'    => $testEmail,
        'password' => $testPassword,
    ]);
    auth_assert_contains($response, 'Location: index.php?controller=san_pham&action=index', 'redirect after login');
});

echo "\nResult: {$passed} passed, {$failed} failed\n";

exit($failed > 0 ? 1 : 0);
