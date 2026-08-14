<?php

/**
 * Script kiểm tra Validator — chạy: php shared/test_validator.php
 */

declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once __DIR__ . '/Validator.php';

$passed = 0;
$failed = 0;

function assertTrue(bool $condition, string $label): void
{
    global $passed, $failed;

    if ($condition) {
        $passed++;
        echo "[OK] {$label}\n";
        return;
    }

    $failed++;
    echo "[FAIL] {$label}\n";
}

function assertEquals($expected, $actual, string $label): void
{
    assertTrue($expected === $actual, $label . ' (expected: ' . var_export($expected, true) . ', got: ' . var_export($actual, true) . ')');
}

echo "=== Validator Tests ===\n\n";

// required
$v = Validator::make([], ['name' => 'required']);
assertTrue($v->fails(), 'required fails on empty');
assertEquals('Trường này không được để trống.', $v->first('name'), 'required message');

$v = Validator::make(['name' => '  '], ['name' => 'required']);
assertTrue($v->fails(), 'required fails on whitespace');

$v = Validator::make(['name' => 'Tech Store'], ['name' => 'required']);
assertTrue($v->passes(), 'required passes with value');

// email
$v = Validator::make(['email' => 'invalid'], ['email' => 'required|email']);
assertTrue($v->fails(), 'email fails on invalid format');

$v = Validator::make(['email' => 'user@example.com'], ['email' => 'required|email']);
assertTrue($v->passes(), 'email passes on valid format');

// min / max
$v = Validator::make(['password' => '12345'], ['password' => 'required|min:6']);
assertTrue($v->fails(), 'min fails below threshold');

$v = Validator::make(['password' => '123456'], ['password' => 'required|min:6']);
assertTrue($v->passes(), 'min passes at threshold');

$v = Validator::make(['name' => str_repeat('a', 101)], ['name' => 'required|max:100']);
assertTrue($v->fails(), 'max fails above threshold');

// numeric / integer
$v = Validator::make(['gia' => 'abc'], ['gia' => 'required|numeric']);
assertTrue($v->fails(), 'numeric fails on non-number');

$v = Validator::make(['gia' => '1999000'], ['gia' => 'required|numeric']);
assertTrue($v->passes(), 'numeric passes on number string');

$v = Validator::make(['so_luong' => '1.5'], ['so_luong' => 'required|integer']);
assertTrue($v->fails(), 'integer fails on float string');

$v = Validator::make(['so_luong' => '10'], ['so_luong' => 'required|integer']);
assertTrue($v->passes(), 'integer passes on int string');

// min_value / max_value
$v = Validator::make(['gia' => '0'], ['gia' => 'required|numeric|min_value:1']);
assertTrue($v->fails(), 'min_value fails below minimum');

$v = Validator::make(['gia' => '100'], ['gia' => 'required|numeric|min_value:1|max_value:999999999']);
assertTrue($v->passes(), 'min_value/max_value pass in range');

// phone
$v = Validator::make(['phone' => '84901234567'], ['phone' => 'required|phone']);
assertTrue($v->fails(), 'phone fails without leading 0');

$v = Validator::make(['phone' => '0901234567'], ['phone' => 'required|phone']);
assertTrue($v->passes(), 'phone passes valid VN number');

// same (password confirmation)
$v = Validator::make(
    ['newPassword' => 'secret123', 'ConfirmPassword' => 'secret456'],
    ['ConfirmPassword' => 'required|same:newPassword']
);
assertTrue($v->fails(), 'same fails when values differ');

$v = Validator::make(
    ['newPassword' => 'secret123', 'ConfirmPassword' => 'secret123'],
    ['ConfirmPassword' => 'required|same:newPassword']
);
assertTrue($v->passes(), 'same passes when values match');

// in
$v = Validator::make(['payment' => 'PAYPAL'], ['payment' => 'required|in:COD,VNPAY']);
assertTrue($v->fails(), 'in fails on invalid option');

$v = Validator::make(['payment' => 'COD'], ['payment' => 'required|in:COD,VNPAY']);
assertTrue($v->passes(), 'in passes on valid option');

// nullable
$v = Validator::make(['note' => ''], ['note' => 'nullable|max:1000']);
assertTrue($v->passes(), 'nullable skips other rules when empty');

// custom message
$v = Validator::make(
    ['password' => '123'],
    ['password' => 'required|min:6'],
    ['password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.']
);

assertEquals(
    'Mật khẩu phải có ít nhất 6 ký tự.',
    $v->first('password'),
    'custom min message'
);

// wrong type data
$v = Validator::make(['so_luong' => ['bad']], ['so_luong' => 'required|integer']);
assertTrue($v->fails(), 'integer fails on array value');

// exists / unique with DB (optional — only if DB available)
try {
    require_once __DIR__ . '/../website/config/Database.php';
    $db = new Database();
    $pdo = $db->getConnection();

    if ($pdo instanceof PDO) {
        $v = Validator::make(['id' => '999999999'], ['id' => 'required|integer|exists:san_pham,id'], [], $pdo);
        assertTrue($v->fails(), 'exists fails when record missing');

        $stmt = $pdo->query('SELECT id FROM san_pham LIMIT 1');
        $row = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : false;

        if ($row && isset($row['id'])) {
            $existingId = (string) $row['id'];
            $v = Validator::make(['id' => $existingId], ['id' => 'required|integer|exists:san_pham,id'], [], $pdo);
            assertTrue($v->passes(), 'exists passes when record found');
        }

        $uniqueEmail = 'validator_test_' . time() . '@example.com';
        $v = Validator::make(['email' => $uniqueEmail], ['email' => 'required|email|unique:users,email'], [], $pdo);
        assertTrue($v->passes(), 'unique passes for new email');

        $stmt = $pdo->query('SELECT email FROM users LIMIT 1');
        $user = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : false;

        if ($user && !empty($user['email'])) {
            $v = Validator::make(['email' => $user['email']], ['email' => 'required|email|unique:users,email'], [], $pdo);
            assertTrue($v->fails(), 'unique fails for existing email');
        }
    }
} catch (Throwable $e) {
    echo "[SKIP] DB tests: " . Validator::safeMessage($e) . "\n";
}

// flash helpers (session)
Validator::clearFlash();
Validator::flashInput(['email' => 'a@b.com', 'password' => 'secret'], ['password']);
assertEquals('a@b.com', Validator::old('email'), 'flashInput/old keeps safe fields');
assertEquals('', Validator::old('password'), 'flashInput excludes password');

Validator::flashErrors(['email' => ['Email không đúng định dạng.']]);
$flashed = Validator::getFlashedErrors();
assertTrue(isset($flashed['email']), 'flashErrors/getFlashedErrors works');
assertTrue(empty(Validator::getFlashedErrors()), 'getFlashedErrors clears after read');

Validator::clearFlash();

echo "\n=== Summary: {$passed} passed, {$failed} failed ===\n";

exit($failed > 0 ? 1 : 0);
