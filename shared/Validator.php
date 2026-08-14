<?php

/**
 * Validator dùng chung cho website + admin.
 *
 * Cách dùng:
 *   $validator = Validator::make($_POST, [
 *       'email'    => 'required|email|max:255',
 *       'password' => 'required|min:6|max:255',
 *   ], [], $pdo);
 *
 *   if ($validator->fails()) {
 *       Validator::flashErrors($validator->errors());
 *       Validator::flashInput($_POST, ['password']);
 *       // quay lại form...
 *   }
 */
class Validator
{
    /** @var array<string, mixed> */
    private $data;

    /** @var array<string, string|array<int, string>> */
    private $rules;

    /** @var array<string, string> */
    private $customMessages;

    /** @var array<string, array<int, string>> */
    private $errors = [];

    /** @var PDO|null */
    private $conn;

    /** @var array<string, string> */
    private static $defaultMessages = [
        'required'  => 'Trường này không được để trống.',
        'email'     => 'Email không đúng định dạng.',
        'min'       => 'Giá trị phải có ít nhất :min ký tự.',
        'max'       => 'Giá trị không được vượt quá :max ký tự.',
        'numeric'   => 'Giá trị phải là số.',
        'integer'   => 'Giá trị phải là số nguyên.',
        'min_value' => 'Giá trị phải lớn hơn hoặc bằng :min.',
        'max_value' => 'Giá trị phải nhỏ hơn hoặc bằng :max.',
        'phone'     => 'Số điện thoại không hợp lệ.',
        'url'       => 'URL không đúng định dạng.',
        'same'      => 'Giá trị xác nhận không khớp.',
        'different' => 'Giá trị phải khác :other.',
        'unique'    => 'Giá trị này đã tồn tại.',
        'exists'    => 'Dữ liệu được chọn không tồn tại.',
        'in'        => 'Giá trị được chọn không hợp lệ.',
        'regex'     => 'Giá trị không đúng định dạng.',
        'db'        => 'Không thể kiểm tra dữ liệu lúc này. Vui lòng thử lại sau.',
    ];

    /**
     * @param array<string, mixed> $data
     * @param array<string, string|array<int, string>> $rules
     * @param array<string, string> $customMessages
     */
    public function __construct(array $data, array $rules, array $customMessages = [], ?PDO $conn = null)
    {
        $this->data = $this->normalizeInput($data);
        $this->rules = $rules;
        $this->customMessages = $customMessages;
        $this->conn = $conn;
    }

    /**
     * @param array<string, mixed> $data
     * @param array<string, string|array<int, string>> $rules
     * @param array<string, string> $customMessages
     */
    public static function make(array $data, array $rules, array $customMessages = [], ?PDO $conn = null): self
    {
        $validator = new self($data, $rules, $customMessages, $conn);
        $validator->validate();

        return $validator;
    }

    public function validate(): void
    {
        $this->errors = [];

        foreach ($this->rules as $field => $ruleSet) {
            $rules = $this->parseRules($ruleSet);

            if ($this->shouldSkipField($field, $rules)) {
                continue;
            }

            foreach ($rules as $rule) {
                if ($rule === 'nullable') {
                    continue;
                }

                $this->applyRule($field, $rule);

                if ($this->hasError($field)) {
                    break;
                }
            }
        }
    }

    public function passes(): bool
    {
        return empty($this->errors);
    }

    public function fails(): bool
    {
        return !$this->passes();
    }

    /**
     * @return array<string, array<int, string>>
     */
    public function errors(): array
    {
        return $this->errors;
    }

    /**
     * @return array<string, string>
     */
    public function errorsFlat(): array
    {
        $flat = [];

        foreach ($this->errors as $field => $messages) {
            $flat[$field] = $messages[0] ?? '';
        }

        return $flat;
    }

    public function first(string $field): ?string
    {
        return $this->errors[$field][0] ?? null;
    }

    /**
     * @param array<string, mixed> $data
     * @param array<int, string> $except Keys không lưu (password, token, ...)
     */
    public static function flashInput(array $data, array $except = []): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            return;
        }

        $safe = $data;

        foreach ($except as $key) {
            unset($safe[$key]);
        }

        unset($safe['password'], $safe['confirmPassword'], $safe['currentPassword'], $safe['newPassword'], $safe['ConfirmPassword'], $safe['mk']);

        $_SESSION['_validation_old'] = $safe;
    }

    /**
     * @param array<string, array<int, string>|string> $errors
     */
    public static function flashErrors(array $errors): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            return;
        }

        $_SESSION['_validation_errors'] = $errors;
    }

    /**
     * @return array<string, array<int, string>>
     */
    public static function getFlashedErrors(): array
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            return [];
        }

        $errors = $_SESSION['_validation_errors'] ?? [];
        unset($_SESSION['_validation_errors']);

        return is_array($errors) ? $errors : [];
    }

    /**
     * @param mixed $default
     * @return mixed
     */
    public static function old(string $key, $default = '')
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            return $default;
        }

        $value = $_SESSION['_validation_old'][$key] ?? $default;

        if (is_string($value)) {
            return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }

        return $value;
    }

    public static function clearFlash(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            return;
        }

        unset($_SESSION['_validation_old'], $_SESSION['_validation_errors']);
    }

    /**
     * Che lỗi DB/exception — không lộ chi tiết kỹ thuật.
     */
    public static function safeMessage(?Throwable $e = null): string
    {
        return self::$defaultMessages['db'];
    }

    /**
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     */
    private function normalizeInput(array $data): array
    {
        $normalized = [];

        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $normalized[$key] = trim($value);
            } else {
                $normalized[$key] = $value;
            }
        }

        return $normalized;
    }

    /**
     * @param string|array<int, string> $ruleSet
     * @return array<int, string>
     */
    private function parseRules($ruleSet): array
    {
        if (is_array($ruleSet)) {
            return $ruleSet;
        }

        return array_values(array_filter(explode('|', (string) $ruleSet)));
    }

    /**
     * @param array<int, string> $rules
     */
    private function shouldSkipField(string $field, array $rules): bool
    {
        if (!in_array('nullable', $rules, true)) {
            return false;
        }

        return $this->isEmptyValue($this->getValue($field));
    }

    private function applyRule(string $field, string $rule): void
    {
        [$name, $params] = $this->parseRule($rule);
        $value = $this->getValue($field);

        switch ($name) {
            case 'required':
                if ($this->isEmptyValue($value)) {
                    $this->addError($field, 'required');
                }
                break;

            case 'email':
                if (!$this->isEmptyValue($value) && !filter_var((string) $value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($field, 'email');
                }
                break;

            case 'min':
                if (!$this->isEmptyValue($value) && !$this->validateMinLength($value, (int) ($params[0] ?? 0))) {
                    $this->addError($field, 'min', [':min' => $params[0] ?? '0']);
                }
                break;

            case 'max':
                if (!$this->isEmptyValue($value) && !$this->validateMaxLength($value, (int) ($params[0] ?? 0))) {
                    $this->addError($field, 'max', [':max' => $params[0] ?? '0']);
                }
                break;

            case 'numeric':
                if (!$this->isEmptyValue($value) && !is_numeric($value)) {
                    $this->addError($field, 'numeric');
                }
                break;

            case 'integer':
                if (!$this->isEmptyValue($value) && filter_var($value, FILTER_VALIDATE_INT) === false) {
                    $this->addError($field, 'integer');
                }
                break;

            case 'min_value':
                if (!$this->isEmptyValue($value) && is_numeric($value) && (float) $value < (float) ($params[0] ?? 0)) {
                    $this->addError($field, 'min_value', [':min' => $params[0] ?? '0']);
                }
                break;

            case 'max_value':
                if (!$this->isEmptyValue($value) && is_numeric($value) && (float) $value > (float) ($params[0] ?? 0)) {
                    $this->addError($field, 'max_value', [':max' => $params[0] ?? '0']);
                }
                break;

            case 'phone':
                if (!$this->isEmptyValue($value) && !preg_match('/^0[0-9]{9,10}$/', (string) $value)) {
                    $this->addError($field, 'phone');
                }
                break;

            case 'url':
                if (!$this->isEmptyValue($value) && !filter_var((string) $value, FILTER_VALIDATE_URL)) {
                    $this->addError($field, 'url');
                }
                break;

            case 'same':
                $other = $params[0] ?? '';
                if ((string) $value !== (string) $this->getValue($other)) {
                    $this->addError($field, 'same');
                }
                break;

            case 'different':
                $other = $params[0] ?? '';
                if ((string) $value === (string) $this->getValue($other)) {
                    $this->addError($field, 'different', [':other' => $other]);
                }
                break;

            case 'in':
                if (!$this->isEmptyValue($value) && !in_array((string) $value, $params, true)) {
                    $this->addError($field, 'in');
                }
                break;

            case 'regex':
                $pattern = $params[0] ?? '';
                if (!$this->isEmptyValue($value) && !preg_match($pattern, (string) $value)) {
                    $this->addError($field, 'regex');
                }
                break;

            case 'unique':
                $this->validateUnique($field, $value, $params);
                break;

            case 'exists':
                $this->validateExists($field, $value, $params);
                break;
        }
    }

    /**
     * @return array{0: string, 1: array<int, string>}
     */
    private function parseRule(string $rule): array
    {
        if (strpos($rule, ':') === false) {
            return [$rule, []];
        }

        [$name, $paramString] = explode(':', $rule, 2);

        if ($name === 'regex') {
            return [$name, [$paramString]];
        }

        return [$name, array_map('trim', explode(',', $paramString))];
    }

    /**
     * @param mixed $value
     */
    private function validateMinLength($value, int $min): bool
    {
        if ($min <= 0) {
            return true;
        }

        if (is_array($value)) {
            return count($value) >= $min;
        }

        return mb_strlen((string) $value) >= $min;
    }

    /**
     * @param mixed $value
     */
    private function validateMaxLength($value, int $max): bool
    {
        if ($max <= 0) {
            return true;
        }

        if (is_array($value)) {
            return count($value) <= $max;
        }

        return mb_strlen((string) $value) <= $max;
    }

    /**
     * unique:table,column[,exceptColumn,exceptValue]
     *
     * @param mixed $value
     * @param array<int, string> $params
     */
    private function validateUnique(string $field, $value, array $params): void
    {
        if ($this->isEmptyValue($value)) {
            return;
        }

        $table = $params[0] ?? '';
        $column = $params[1] ?? '';
        $exceptColumn = $params[2] ?? null;
        $exceptValue = $params[3] ?? null;

        if (!$this->isValidIdentifier($table) || !$this->isValidIdentifier($column)) {
            $this->addError($field, 'db');
            return;
        }

        if ($exceptColumn !== null && !$this->isValidIdentifier($exceptColumn)) {
            $this->addError($field, 'db');
            return;
        }

        $sql = "SELECT COUNT(*) FROM `{$table}` WHERE `{$column}` = :value";
        $bindings = [':value' => $value];

        if ($exceptColumn !== null && $exceptValue !== null && $exceptValue !== '') {
            $sql .= " AND `{$exceptColumn}` != :except_value";
            $bindings[':except_value'] = $exceptValue;
        }

        $count = $this->safeQueryCount($sql, $bindings);

        if ($count === null) {
            $this->addError($field, 'db');
            return;
        }

        if ($count > 0) {
            $this->addError($field, 'unique');
        }
    }

    /**
     * exists:table,column
     *
     * @param mixed $value
     * @param array<int, string> $params
     */
    private function validateExists(string $field, $value, array $params): void
    {
        if ($this->isEmptyValue($value)) {
            return;
        }

        $table = $params[0] ?? '';
        $column = $params[1] ?? 'id';

        if (!$this->isValidIdentifier($table) || !$this->isValidIdentifier($column)) {
            $this->addError($field, 'db');
            return;
        }

        $sql = "SELECT COUNT(*) FROM `{$table}` WHERE `{$column}` = :value";
        $count = $this->safeQueryCount($sql, [':value' => $value]);

        if ($count === null) {
            $this->addError($field, 'db');
            return;
        }

        if ($count <= 0) {
            $this->addError($field, 'exists');
        }
    }

    /**
     * @param array<string, scalar|null> $bindings
     */
    private function safeQueryCount(string $sql, array $bindings): ?int
    {
        if (!$this->conn instanceof PDO) {
            return null;
        }

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($bindings);

            return (int) $stmt->fetchColumn();
        } catch (Throwable $e) {
            return null;
        }
    }

    private function isValidIdentifier(string $name): bool
    {
        return (bool) preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $name);
    }

    /**
     * @param mixed $value
     */
    private function isEmptyValue($value): bool
    {
        if ($value === null) {
            return true;
        }

        if (is_string($value) && $value === '') {
            return true;
        }

        if (is_array($value) && count($value) === 0) {
            return true;
        }

        return false;
    }

    /**
     * @return mixed
     */
    private function getValue(string $field)
    {
        if (array_key_exists($field, $this->data)) {
            return $this->data[$field];
        }

        // Hỗ trợ field dạng "qty.12" nếu data là mảng lồng — giữ đơn giản
        if (strpos($field, '.') !== false) {
            $segments = explode('.', $field);
            $value = $this->data;

            foreach ($segments as $segment) {
                if (!is_array($value) || !array_key_exists($segment, $value)) {
                    return null;
                }
                $value = $value[$segment];
            }

            return $value;
        }

        return null;
    }

    private function hasError(string $field): bool
    {
        return !empty($this->errors[$field]);
    }

    /**
     * @param array<string, string> $replacements
     */
    private function addError(string $field, string $rule, array $replacements = []): void
    {
        $messageKey = $field . '.' . $rule;
        $message = $this->customMessages[$messageKey]
            ?? $this->customMessages[$rule]
            ?? self::$defaultMessages[$rule]
            ?? self::$defaultMessages['regex'];

        foreach ($replacements as $search => $replace) {
            $message = str_replace($search, (string) $replace, $message);
        }

        $this->errors[$field][] = $message;
    }
}
