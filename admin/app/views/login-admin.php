<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Admin | Tech Store</title>
    <?php include __DIR__ . '/components/head-resources.php'; ?>
</head>

<body class="min-h-screen flex items-center justify-center p-4 sm:p-6">
    <?php $errors = $errors ?? form_get_errors(); ?>
    <div class="w-full max-w-md adm-card p-6 sm:p-8">
        <div class="text-center mb-6">
            <div class="w-14 h-14 mx-auto mb-4 rounded-2xl bg-blue-50 border border-blue-100 flex items-center justify-center">
                <svg class="w-7 h-7 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-slate-900">Đăng nhập Admin</h2>
            <p class="text-slate-500 mt-2 text-sm">Đăng nhập vào tài khoản quản trị</p>
        </div>

        <?php if (!empty($errors['auth'])): ?>
            <p class="text-sm text-red-600 mb-4 text-center" role="alert"><?= htmlspecialchars($errors['auth'], ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>

        <form action="index.php?controller=auth&action=login" method="POST" id="formSumit" class="space-y-4" novalidate>
            <div>
                <label for="adminEmail" class="adm-label">Email</label>
                <input type="email" id="adminEmail" name="email" value="<?= form_old_value('email') ?>" class="<?= form_adm_input_class($errors, 'email') ?>" placeholder="name@example.com"<?= form_field_attrs($errors, 'email', 'adminEmail') ?>>
                <?php $field = 'email'; $inputId = 'adminEmail'; include __DIR__ . '/components/form-error.php'; ?>
            </div>
            <div>
                <label for="adminPassword" class="adm-label">Mật khẩu</label>
                <input type="password" id="adminPassword" name="password" class="<?= form_adm_input_class($errors, 'password') ?>" placeholder="••••••••"<?= form_field_attrs($errors, 'password', 'adminPassword') ?>>
                <?php $field = 'password'; $inputId = 'adminPassword'; include __DIR__ . '/components/form-error.php'; ?>
            </div>
            <button type="submit" class="adm-btn-primary w-full h-11">Đăng nhập</button>
        </form>
    </div>
</body>

</html>
