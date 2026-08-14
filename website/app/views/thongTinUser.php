<!doctype html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tài khoản của tôi | Tech Store</title>
  <?php include __DIR__ . '/components/head-resources.php'; ?>
</head>

<body class="font-sans bg-slate-50 text-slate-700 antialiased">
  <div class="flex flex-col min-h-screen">
    <?php include __DIR__ . '/components/header.php'; ?>

    <main class="flex-1 py-8 lg:py-10">
      <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-6 lg:gap-8">
          <?php $accountActive = 'profile'; include __DIR__ . '/components/account-sidebar.php'; ?>

          <div class="flex-1 min-w-0">
            <div class="ds-card p-5 sm:p-8">
              <h2 class="text-xl sm:text-2xl font-bold text-slate-900 mb-6 sm:mb-8">Cập nhật thông tin tài khoản</h2>
              <?php $errors = $errors ?? form_get_errors(); ?>
              <?php include __DIR__ . '/components/form-success.php'; ?>
              <form action="index.php?controller=login&action=controllerUpateUser" method="POST" class="space-y-5 max-w-xl" novalidate>
                <div>
                  <label for="userName" class="ds-label">Họ và tên</label>
                  <input id="userName" type="text" name="name" placeholder="Nhập họ và tên" class="<?= form_input_class($errors, 'name') ?>" value="<?= form_old_value('name', $user['name'] ?? '') ?>"<?= form_field_attrs($errors, 'name', 'userName') ?> />
                  <?php $field = 'name'; $inputId = 'userName'; include __DIR__ . '/components/form-error.php'; ?>
                </div>
                <div>
                  <label for="userEmail" class="ds-label">Email</label>
                  <input id="userEmail" type="email" name="email" placeholder="Nhập email" class="<?= form_input_class($errors, 'email') ?>" value="<?= form_old_value('email', $user['email'] ?? '') ?>"<?= form_field_attrs($errors, 'email', 'userEmail') ?> />
                  <?php $field = 'email'; $inputId = 'userEmail'; include __DIR__ . '/components/form-error.php'; ?>
                </div>
                <div>
                  <label for="userPhone" class="ds-label">Số điện thoại</label>
                  <input id="userPhone" type="text" name="phone" placeholder="Nhập số điện thoại" class="<?= form_input_class($errors, 'phone') ?>" value="<?= form_old_value('phone', $user['phone'] ?? '') ?>"<?= form_field_attrs($errors, 'phone', 'userPhone') ?> />
                  <?php $field = 'phone'; $inputId = 'userPhone'; include __DIR__ . '/components/form-error.php'; ?>
                </div>
                <button type="submit" class="ds-btn-primary w-full sm:w-auto px-8 h-11">Cập nhật</button>
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
