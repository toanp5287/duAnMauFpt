<!DOCTYPE html>

<html lang="vi">



<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sửa loại hàng | Tech Store Admin</title>

    <?php include __DIR__ . '/components/head-resources.php'; ?>

</head>



<body>

    <div class="flex min-h-screen">

        <?php include __DIR__ . '/sitebar.php'; ?>



        <main class="flex-1 lg:ml-64 pt-14 lg:pt-0 p-4 sm:p-6 lg:p-8 w-full min-w-0">

            <header class="mb-6">

                <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Sửa loại hàng</h1>

            </header>



            <div class="adm-card p-5 sm:p-8 max-w-lg mx-auto lg:mx-0">

                <?php $errors = $errors ?? form_get_errors(); ?>

                <?php if (!empty($errors['id'])): ?>

                    <p class="text-sm text-red-600 mb-4" role="alert"><?= htmlspecialchars($errors['id'], ENT_QUOTES, 'UTF-8') ?></p>

                <?php endif; ?>

                <form method="POST" class="space-y-4" novalidate>

                    <input type="hidden" name="id" value="<?php echo $list_loai['id']; ?>">

                    <div>

                        <label for="ten_loai" class="adm-label">Tên danh mục</label>

                        <input type="text" id="ten_loai" name="ten_loai" value="<?= form_old_value('ten_loai', $list_loai['ten_loai'] ?? '') ?>" class="<?= form_adm_input_class($errors, 'ten_loai') ?>"<?= form_field_attrs($errors, 'ten_loai', 'ten_loai') ?>>

                        <?php $field = 'ten_loai'; $inputId = 'ten_loai'; include __DIR__ . '/components/form-error.php'; ?>

                    </div>

                    <button type="submit" class="adm-btn-primary w-full h-11">Cập nhật</button>

                </form>

                <a href="index.php?controller=loai_hang&action=index" class="adm-btn-secondary w-full h-11 mt-4 text-center">Quay lại danh sách</a>

            </div>

        </main>

    </div>

</body>



</html>


