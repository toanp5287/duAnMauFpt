<?php

/**
 * Helper upload ảnh an toàn — dùng chung admin/website.
 */

/**
 * @param array<string, mixed> $files $_FILES
 * @param array<int, string> $keys
 * @return array<string, mixed>|null
 */
function upload_resolve_file(array $files, array $keys): ?array
{
    foreach ($keys as $key) {
        if (isset($files[$key]) && is_array($files[$key])) {
            return $files[$key];
        }
    }

    return null;
}

/**
 * @param array<string, mixed> $file
 * @return array{0: bool, 1: string, 2: string} [valid, errorMessage, extension]
 */
function upload_validate_image(array $file, int $maxBytes = 5242880): array
{
    if (!isset($file['error']) || (int) $file['error'] === UPLOAD_ERR_NO_FILE) {
        return [true, '', ''];
    }

    if ((int) $file['error'] !== UPLOAD_ERR_OK) {
        return [false, 'Không thể tải file lên. Vui lòng thử lại.', ''];
    }

    $tmpName = $file['tmp_name'] ?? '';
    if ($tmpName === '' || !is_uploaded_file($tmpName)) {
        return [false, 'File tải lên không hợp lệ.', ''];
    }

    if (($file['size'] ?? 0) > $maxBytes) {
        return [false, 'Kích thước file vượt quá giới hạn cho phép.', ''];
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = $finfo ? finfo_file($finfo, $tmpName) : '';
    if ($finfo) {
        finfo_close($finfo);
    }

    $allowed = [
        'image/jpeg' => 'jpg',
        'image/png'  => 'png',
        'image/gif'  => 'gif',
        'image/webp' => 'webp',
    ];

    if (!isset($allowed[$mime])) {
        return [false, 'Chỉ chấp nhận file hình ảnh (JPG, PNG, GIF, WEBP).', ''];
    }

    return [true, '', $allowed[$mime]];
}

/**
 * @param array<string, mixed> $files
 * @param array<int, string> $keys
 * @return array{0: bool, 1: string, 2: string} [success, errorMessage, storedFilename]
 */
function upload_store_image(array $files, array $keys, string $uploadDir, bool $required = false): array
{
    $file = upload_resolve_file($files, $keys);

    if ($file === null) {
        return $required
            ? [false, 'Vui lòng chọn hình ảnh.', '']
            : [true, '', ''];
    }

    [$valid, $error, $extension] = upload_validate_image($file);
    if (!$valid) {
        return [false, $error, ''];
    }

    if ($extension === '') {
        return [true, '', ''];
    }

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $filename = time() . '_' . bin2hex(random_bytes(4)) . '.' . $extension;
    $target = rtrim($uploadDir, '/\\') . DIRECTORY_SEPARATOR . $filename;

    if (!move_uploaded_file($file['tmp_name'], $target)) {
        return [false, 'Không thể lưu file. Vui lòng thử lại.', ''];
    }

    return [true, '', $filename];
}
