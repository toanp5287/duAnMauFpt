<?php

/**
 * Helper hiển thị lỗi / old input trên View.
 * Dùng chung website + admin.
 */

/**
 * @return array<string, string> field => first error message
 */
function form_get_errors(): array
{
    if (isset($GLOBALS['form_errors']) && is_array($GLOBALS['form_errors'])) {
        return $GLOBALS['form_errors'];
    }

    $flat = [];
    $sessionErrors = $_SESSION['_validation_errors'] ?? [];

    if (is_array($sessionErrors)) {
        foreach ($sessionErrors as $field => $messages) {
            if (is_array($messages)) {
                $flat[$field] = (string) ($messages[0] ?? '');
            } else {
                $flat[$field] = (string) $messages;
            }
        }
    }

    unset($_SESSION['_validation_errors']);

    return $flat;
}

/**
 * @param array<string, string> $errors
 */
function form_set_errors(array $errors): void
{
    $GLOBALS['form_errors'] = $errors;
}

function form_has_error(array $errors, string $field): bool
{
    return !empty($errors[$field]);
}

function form_error_message(array $errors, string $field): string
{
    return $errors[$field] ?? '';
}

/**
 * Class CSS input — chỉ field lỗi mới có border đỏ.
 *
 * @param array<string, string> $errors
 */
function form_input_class(array $errors, string $field, string $baseClass = 'ds-input h-11 px-4 text-sm w-full'): string
{
    if (form_has_error($errors, $field)) {
        return $baseClass . ' border-red-600 focus:border-red-600 focus:ring-red-100';
    }

    return $baseClass . ' border-slate-200 focus:border-blue-600 focus:ring-blue-100';
}

/**
 * Class CSS input admin.
 *
 * @param array<string, string> $errors
 */
function form_adm_input_class(array $errors, string $field, string $baseClass = 'adm-input h-11 px-4 text-sm w-full'): string
{
    if (form_has_error($errors, $field)) {
        return $baseClass . ' border-red-600 focus:border-red-600 focus:ring-red-100';
    }

    return $baseClass;
}

function form_old_value(string $field, $default = ''): string
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        return is_string($default) ? htmlspecialchars($default, ENT_QUOTES, 'UTF-8') : '';
    }

    $value = $_SESSION['_validation_old'][$field] ?? $default;

    if (is_string($value)) {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    return '';
}

function form_old_raw(string $field, $default = '')
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        return $default;
    }

    return $_SESSION['_validation_old'][$field] ?? $default;
}

/**
 * Thuộc tính aria cho input có lỗi.
 *
 * @param array<string, string> $errors
 */
function form_field_attrs(array $errors, string $field, string $inputId): string
{
    if (!form_has_error($errors, $field)) {
        return '';
    }

    $errorId = $inputId . '-error';

    return ' aria-invalid="true" aria-describedby="' . htmlspecialchars($errorId, ENT_QUOTES, 'UTF-8') . '"';
}

function form_success_message(): string
{
    $msg = $_SESSION['_validation_success'] ?? '';
    unset($_SESSION['_validation_success']);

    return is_string($msg) ? $msg : '';
}

function form_flash_success(string $message): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        $_SESSION['_validation_success'] = $message;
    }
}

function form_flash_error(string $message): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        $_SESSION['msg'] = $message;
        $_SESSION['type'] = 'danger';
    }
}
