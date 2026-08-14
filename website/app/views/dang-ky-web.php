<!doctype html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tech Store - Đăng ký</title>
    <?php include __DIR__ . '/components/head-resources.php'; ?>
</head>

<body class="font-sans bg-slate-50 text-slate-700 antialiased min-h-screen flex items-center justify-center py-8 px-4 sm:px-6">
    <?php $errors = $errors ?? form_get_errors(); ?>
    <div class="w-full max-w-md ds-card p-6 sm:p-8">
        <div class="text-center mb-6">
            <div class="w-14 h-14 mx-auto mb-4 rounded-2xl bg-blue-50 border border-blue-100 flex items-center justify-center">
                <svg class="w-7 h-7 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <h2 class="text-2xl sm:text-3xl font-bold text-slate-900">Tạo tài khoản</h2>
            <p class="text-slate-500 mt-2 text-sm">Bắt đầu mua sắm ngay hôm nay</p>
        </div>

        <form action="index.php?controller=login&action=xu_ly_dang_ky" method="POST" id="postAdd" class="space-y-4" novalidate>
            <div>
                <label for="name" class="ds-label">Họ tên</label>
                <input id="name" type="text" name="name" value="<?= form_old_value('name') ?>" placeholder="Nguyễn Văn A" class="<?= form_input_class($errors, 'name') ?>"<?= form_field_attrs($errors, 'name', 'name') ?>>
                <?php $field = 'name'; $inputId = 'name'; include __DIR__ . '/components/form-error.php'; ?>
            </div>
            <div>
                <label for="email" class="ds-label">Email</label>
                <input id="email" type="email" name="email" value="<?= form_old_value('email') ?>" placeholder="name@example.com" class="<?= form_input_class($errors, 'email') ?>"<?= form_field_attrs($errors, 'email', 'email') ?>>
                <?php $field = 'email'; $inputId = 'email'; include __DIR__ . '/components/form-error.php'; ?>
            </div>
            <div>
                <label for="phone" class="ds-label">Số điện thoại</label>
                <input id="phone" type="text" name="phone" value="<?= form_old_value('phone') ?>" placeholder="0901234567" class="<?= form_input_class($errors, 'phone') ?>"<?= form_field_attrs($errors, 'phone', 'phone') ?>>
                <?php $field = 'phone'; $inputId = 'phone'; include __DIR__ . '/components/form-error.php'; ?>
            </div>
            <div>
                <label for="password" class="ds-label">Mật khẩu</label>
                <input id="password" type="password" name="password" placeholder="••••••••" class="<?= form_input_class($errors, 'password') ?>"<?= form_field_attrs($errors, 'password', 'password') ?>>
                <?php $field = 'password'; $inputId = 'password'; include __DIR__ . '/components/form-error.php'; ?>
            </div>
            <div>
                <label for="confirmPassword" class="ds-label">Xác nhận mật khẩu</label>
                <input id="confirmPassword" type="password" name="confirmPassword" placeholder="••••••••" class="<?= form_input_class($errors, 'confirmPassword') ?>"<?= form_field_attrs($errors, 'confirmPassword', 'confirmPassword') ?>>
                <?php $field = 'confirmPassword'; $inputId = 'confirmPassword'; include __DIR__ . '/components/form-error.php'; ?>
            </div>
            <button type="submit" class="ds-btn-primary w-full h-11">Đăng ký ngay</button>
        </form>

        <div class="relative my-6">
            <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-slate-200"></div></div>
            <div class="relative flex justify-center"><span class="bg-white px-4 text-sm text-slate-500">Đã có tài khoản?</span></div>
        </div>

        <a href="index.php?controller=login&action=index" class="ds-btn-secondary w-full h-11">Đăng nhập</a>
        <p class="text-center mt-6"><a href="index.php" class="text-sm text-slate-500 hover:text-blue-600 transition-colors duration-200">← Về cửa hàng</a></p>
    </div>
</body>

</html>
