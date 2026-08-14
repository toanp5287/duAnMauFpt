<?php
/**
 * Test Review + remaining form validation (Backend Round 7).
 * Chạy: php shared/test_review_forms.php
 */

declare(strict_types=1);

require_once __DIR__ . '/../website/config/Database.php';
require_once __DIR__ . '/Validator.php';
require_once __DIR__ . '/upload_helpers.php';

$passed = 0;
$failed = 0;

function review_test(string $name, callable $fn): void
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

echo "Review + forms validation tests\n\n";

$pdo = (new Database())->getConnection();

review_test('Review: empty rating', function () {
    $v = Validator::make(['so_sao' => ''], ['so_sao' => 'required|integer|in:1,2,3,4,5'], [
        'so_sao.required' => 'Vui lòng chọn số sao.',
    ]);
    if ($v->first('so_sao') !== 'Vui lòng chọn số sao.') {
        throw new RuntimeException('Expected rating required message.');
    }
});

review_test('Review: rating out of range', function () {
    $v = Validator::make(['so_sao' => '6'], ['so_sao' => 'required|integer|in:1,2,3,4,5'], [
        'so_sao.in' => 'Số sao phải từ 1 đến 5.',
    ]);
    if ($v->first('so_sao') !== 'Số sao phải từ 1 đến 5.') {
        throw new RuntimeException('Expected out of range message.');
    }
});

review_test('Review: rating text', function () {
    $v = Validator::make(['so_sao' => 'abc'], ['so_sao' => 'required|integer|in:1,2,3,4,5'], [
        'so_sao.integer' => 'Số sao phải từ 1 đến 5.',
    ]);
    if ($v->first('so_sao') !== 'Số sao phải từ 1 đến 5.') {
        throw new RuntimeException('Expected integer rating message.');
    }
});

review_test('Review: empty content', function () {
    $v = Validator::make(['danhGia' => ''], ['danhGia' => 'required|min:10|max:2000'], [
        'danhGia.required' => 'Nội dung đánh giá không được để trống.',
    ]);
    if ($v->first('danhGia') !== 'Nội dung đánh giá không được để trống.') {
        throw new RuntimeException('Expected empty content message.');
    }
});

review_test('Review: invalid product id', function () use ($pdo) {
    $v = Validator::make(['id_sp' => '99999999'], ['id_sp' => 'required|integer|min_value:1|exists:san_pham,id'], [
        'id_sp.exists' => 'Sản phẩm không tồn tại.',
    ], $pdo);
    if ($v->first('id_sp') !== 'Sản phẩm không tồn tại.') {
        throw new RuntimeException('Expected missing product message.');
    }
});

review_test('Change password: new password under 6 chars', function () {
    $v = Validator::make([
        'currentPassword' => 'oldpass123',
        'newPassword'     => 'short',
        'ConfirmPassword' => 'short',
    ], [
        'newPassword' => 'required|min:6|max:255',
    ], [
        'newPassword.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
    ]);
    if ($v->first('newPassword') !== 'Mật khẩu phải có ít nhất 6 ký tự.') {
        throw new RuntimeException('Expected min 6 password message.');
    }
});

review_test('Change password: confirm mismatch', function () {
    $v = Validator::make([
        'currentPassword' => 'oldpass123',
        'newPassword'     => 'newpass123',
        'ConfirmPassword' => 'different123',
    ], [
        'ConfirmPassword' => 'required|same:newPassword',
    ], [
        'ConfirmPassword.same' => 'Mật khẩu xác nhận không khớp.',
    ]);
    if ($v->first('ConfirmPassword') !== 'Mật khẩu xác nhận không khớp.') {
        throw new RuntimeException('Expected confirm mismatch message.');
    }
});

review_test('Upload: reject invalid mime', function () {
    $tmp = tempnam(sys_get_temp_dir(), 'upload');
    file_put_contents($tmp, 'not an image');
    [$valid, $error] = upload_validate_image([
        'error' => UPLOAD_ERR_OK,
        'tmp_name' => $tmp,
        'size' => 12,
    ]);
    @unlink($tmp);
    if ($valid || $error === '') {
        throw new RuntimeException('Expected invalid mime rejection.');
    }
});

review_test('Upload: no file is optional', function () {
    [$valid, $error, $name] = upload_store_image([], ['hinh_anh'], sys_get_temp_dir(), false);
    if (!$valid || $error !== '' || $name !== '') {
        throw new RuntimeException('Expected optional upload to pass.');
    }
});

echo "\nResult: {$passed} passed, {$failed} failed\n";
exit($failed > 0 ? 1 : 0);
