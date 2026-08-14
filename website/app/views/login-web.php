<!doctype html>

<html lang="vi">



<head>

    <meta charset="UTF-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Tech Store - Đăng nhập</title>

    <?php include __DIR__ . '/components/head-resources.php'; ?>

</head>



<body class="font-sans bg-slate-50 text-slate-700 antialiased min-h-screen flex items-center justify-center p-4 sm:p-6">

    <?php $errors = $errors ?? form_get_errors(); ?>

    <div class="w-full max-w-md ds-card p-6 sm:p-8">

        <div class="text-center mb-6 sm:mb-8">

            <a href="index.php" class="w-14 h-14 mx-auto mb-4 rounded-2xl bg-blue-50 border border-blue-100 flex items-center justify-center">

                <svg class="w-7 h-7 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">

                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />

                </svg>

            </a>

            <h2 class="text-2xl sm:text-3xl font-bold text-slate-900">Chào mừng trở lại</h2>

            <p class="text-slate-500 mt-2 text-sm">Vui lòng đăng nhập</p>

        </div>



        <?php include __DIR__ . '/components/form-success.php'; ?>



        <?php if (!empty($errors['auth'])): ?>

            <p id="login-auth-error" class="text-sm text-red-600 mb-4 text-center" role="alert"><?= htmlspecialchars($errors['auth'], ENT_QUOTES, 'UTF-8') ?></p>

        <?php endif; ?>



        <form action="index.php?controller=login&action=xu_ly_dang_nhap" method="POST" id="formSumit" class="space-y-4" novalidate>

            <div>

                <label for="loginEmail" class="ds-label">Email</label>

                <input type="email" id="loginEmail" name="email" value="<?= form_old_value('email') ?>" class="<?= form_input_class($errors, 'email') ?>" placeholder="name@example.com"<?= form_field_attrs($errors, 'email', 'loginEmail') ?>>

                <?php $field = 'email'; $inputId = 'loginEmail'; include __DIR__ . '/components/form-error.php'; ?>

            </div>

            <div>

                <label for="loginPassword" class="ds-label">Mật khẩu</label>

                <input type="password" id="loginPassword" name="password" class="<?= form_input_class($errors, 'password') ?>" placeholder="••••••••"<?= form_field_attrs($errors, 'password', 'loginPassword') ?>>

                <?php $field = 'password'; $inputId = 'loginPassword'; include __DIR__ . '/components/form-error.php'; ?>

            </div>

            <button type="submit" class="ds-btn-primary w-full h-11">Đăng nhập</button>

        </form>



        <div class="relative my-6">

            <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-slate-200"></div></div>

            <div class="relative flex justify-center"><span class="bg-white px-3 text-slate-500 text-sm">Chưa có tài khoản?</span></div>

        </div>



        <a href="index.php?controller=login&action=dang_ky" class="ds-btn-secondary w-full h-11">Tạo tài khoản mới</a>

        <p class="text-center mt-6"><a href="index.php" class="text-sm text-slate-500 hover:text-blue-600 transition-colors duration-200">← Về cửa hàng</a></p>

    </div>

</body>



</html>


