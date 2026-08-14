<!doctype html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Đổi mật khẩu | Tech Store</title>
  <?php include __DIR__ . '/components/head-resources.php'; ?>
</head>

<body class="font-sans bg-slate-50 text-slate-700 antialiased">
  <div class="flex flex-col min-h-screen">
    <?php include __DIR__ . '/components/header.php'; ?>

    <main class="flex-1 py-8 lg:py-10">
      <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-6 lg:gap-8">
          <?php $accountActive = 'password'; include __DIR__ . '/components/account-sidebar.php'; ?>

          <div class="flex-1 min-w-0">
            <div class="ds-card p-5 sm:p-8 max-w-lg">
              <div class="mb-6 sm:mb-8">
                <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Đổi mật khẩu</h1>
                <p class="text-slate-500 mt-2 text-sm">Vui lòng nhập mật khẩu hiện tại và mật khẩu mới.</p>
              </div>

              <?php $errors = $errors ?? form_get_errors(); ?>
              <?php include __DIR__ . '/components/form-success.php'; ?>
              <?php if (!empty($errors['form'])): ?>
                <p class="text-sm text-red-600 mb-4" role="alert"><?= htmlspecialchars($errors['form'], ENT_QUOTES, 'UTF-8') ?></p>
              <?php endif; ?>

              <form action="index.php?controller=login&action=updateMKuser" method="POST" class="space-y-5" novalidate>
                <div>
                  <label for="currentPassword" class="ds-label">Mật khẩu hiện tại</label>
                  <input id="currentPassword" type="password" name="currentPassword" placeholder="Nhập mật khẩu hiện tại" class="<?= form_input_class($errors, 'currentPassword') ?>"<?= form_field_attrs($errors, 'currentPassword', 'currentPassword') ?> />
                  <?php $field = 'currentPassword'; $inputId = 'currentPassword'; include __DIR__ . '/components/form-error.php'; ?>
                </div>
                <div>
                  <label for="newPassword" class="ds-label">Mật khẩu mới</label>
                  <input id="newPassword" type="password" name="newPassword" placeholder="Nhập mật khẩu mới" class="<?= form_input_class($errors, 'newPassword') ?>"<?= form_field_attrs($errors, 'newPassword', 'newPassword') ?> />
                  <?php $field = 'newPassword'; $inputId = 'newPassword'; include __DIR__ . '/components/form-error.php'; ?>
                </div>
                <div>
                  <label for="ConfirmPassword" class="ds-label">Xác nhận mật khẩu mới</label>
                  <input id="ConfirmPassword" type="password" name="ConfirmPassword" placeholder="Nhập lại mật khẩu mới" class="<?= form_input_class($errors, 'ConfirmPassword') ?>"<?= form_field_attrs($errors, 'ConfirmPassword', 'ConfirmPassword') ?> />
                  <?php $field = 'ConfirmPassword'; $inputId = 'ConfirmPassword'; include __DIR__ . '/components/form-error.php'; ?>
                </div>
                <div class="flex flex-col sm:flex-row gap-3 pt-2">
                  <button type="submit" class="ds-btn-primary flex-1 h-11">Cập nhật mật khẩu</button>
                  <a href="index.php?controller=login&action=controllerGETuser" class="ds-btn-secondary flex-1 h-11">Hủy</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </main>

    <?php include __DIR__ . '/components/footer.php'; ?>
  </div>
</body>

</html>
