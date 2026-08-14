<?php
/**
 * Hiển thị lỗi validation cho một field.
 * Cần: $errors (array), $field (string), $inputId (string, optional — mặc định = $field)
 */
$inputId = $inputId ?? $field;
$errorId = $inputId . '-error';
$message = form_error_message($errors ?? [], $field);

if ($message === '') {
    return;
}
?>
<p id="<?= htmlspecialchars($errorId, ENT_QUOTES, 'UTF-8') ?>" class="text-sm text-red-600 mt-1" role="alert"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>
