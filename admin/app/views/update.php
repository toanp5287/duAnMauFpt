<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sản phẩm | Tech Store Admin</title>
    <?php include __DIR__ . '/components/head-resources.php'; ?>
    <script src="https://cdn.tiny.cloud/1/8pxelqmcl6ibgm3a2zvie1pcjkdihinxrz7oxsy878q4tzrc/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'lists link image table code',
            toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image table | code',
            menubar: false,
            height: 300
        });
    </script>
</head>

<body>
    <div class="flex min-h-screen">
        <?php include 'sitebar.php'; ?>

        <main class="flex-1 lg:ml-64 pt-14 lg:pt-0 p-4 sm:p-6 lg:p-8 w-full min-w-0">
            <header class="mb-6">
                <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Sửa sản phẩm</h1>
            </header>

            <div class="adm-card p-5 sm:p-8 max-w-2xl mx-auto lg:mx-0">
                <?php $errors = $errors ?? form_get_errors(); ?>
                <?php if (!empty($errors['id'])): ?>
                    <p class="text-sm text-red-600 mb-4" role="alert"><?= htmlspecialchars($errors['id'], ENT_QUOTES, 'UTF-8') ?></p>
                <?php endif; ?>
                <form method="POST" id="formAdd" enctype="multipart/form-data" class="space-y-4" novalidate>
                    <input type="hidden" name="id" value="<?php echo $san_pham_update['id'] ?>">
                    <div>
                        <label for="ten_tour" class="adm-label">Tên sản phẩm</label>
                        <input type="text" id="ten_tour" name="ten_san_pham" value="<?= form_old_value('ten_san_pham', $san_pham_update['ten_san_pham'] ?? '') ?>" placeholder="Tên sản phẩm" class="<?= form_adm_input_class($errors, 'ten_san_pham') ?>"<?= form_field_attrs($errors, 'ten_san_pham', 'ten_tour') ?>>
                        <?php $field = 'ten_san_pham'; $inputId = 'ten_tour'; include __DIR__ . '/components/form-error.php'; ?>
                    </div>
                    <div>
                        <label for="gia" class="adm-label">Giá sản phẩm</label>
                        <input type="number" id="gia" name="gia" value="<?= form_old_value('gia', $san_pham_update['gia'] ?? '') ?>" placeholder="Giá sản phẩm" class="<?= form_adm_input_class($errors, 'gia') ?>"<?= form_field_attrs($errors, 'gia', 'gia') ?>>
                        <?php $field = 'gia'; $inputId = 'gia'; include __DIR__ . '/components/form-error.php'; ?>
                    </div>
                    <div>
                        <label for="so_luong" class="adm-label">Số lượng</label>
                        <input type="number" id="so_luong" name="so_luong" value="<?= form_old_value('so_luong', $san_pham_update['so_luong'] ?? '') ?>" placeholder="Số lượng" class="<?= form_adm_input_class($errors, 'so_luong') ?>"<?= form_field_attrs($errors, 'so_luong', 'so_luong') ?>>
                        <?php $field = 'so_luong'; $inputId = 'so_luong'; include __DIR__ . '/components/form-error.php'; ?>
                    </div>
                    <div>
                        <label for="mo_ta" class="adm-label">Mô tả</label>
                        <textarea id="mo_ta" name="mo_ta" placeholder="Mô tả" class="<?= form_adm_input_class($errors, 'mo_ta', 'adm-input px-4 py-3 text-sm min-h-[120px] w-full') ?>"<?= form_field_attrs($errors, 'mo_ta', 'mo_ta') ?>><?= form_old_value('mo_ta', $san_pham_update['mo_ta'] ?? '') ?></textarea>
                        <?php $field = 'mo_ta'; $inputId = 'mo_ta'; include __DIR__ . '/components/form-error.php'; ?>
                    </div>
                    <div>
                        <label for="ten_danh_muc" class="adm-label">Loại hàng</label>
                        <?php $loaiOld = form_old_raw('loai_hang_id', $san_pham_update['loai_hang_id'] ?? ''); ?>
                        <select name="loai_hang_id" id="ten_danh_muc" class="<?= form_adm_input_class($errors, 'loai_hang_id') ?>"<?= form_field_attrs($errors, 'loai_hang_id', 'ten_danh_muc') ?>>
                            <option value="">-- Chọn loại hàng --</option>
                            <?php foreach ($list_loai as $row) { ?>
                                <option value="<?php echo $row['id'] ?>" <?= (string)$loaiOld === (string)$row['id'] ? 'selected' : '' ?>>
                                    <?php echo $row['ten_loai'] ?>
                                </option>
                            <?php } ?>
                        </select>
                        <?php $field = 'loai_hang_id'; $inputId = 'ten_danh_muc'; include __DIR__ . '/components/form-error.php'; ?>
                    </div>
                    <div class="text-center py-2">
                        <p class="mb-3 text-sm font-medium text-slate-700">Ảnh hiện tại</p>
                        <img src="./uploads/<?php echo $san_pham_update['hinh_anh']; ?>" alt="" class="mx-auto h-48 sm:h-64 w-full max-w-[300px] rounded-xl border border-slate-200 object-cover">
                    </div>
                    <div>
                        <label for="hinh_anh" class="adm-label">Hình ảnh mới</label>
                        <input type="file" id="hinh_anh" name="hinh_anh" placeholder="hinh anh" class="<?= form_adm_input_class($errors, 'hinh_anh', 'adm-input px-4 py-2.5 text-sm file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-600') ?>"<?= form_field_attrs($errors, 'hinh_anh', 'hinh_anh') ?>>
                        <?php $field = 'hinh_anh'; $inputId = 'hinh_anh'; include __DIR__ . '/components/form-error.php'; ?>
                    </div>
                    <button type="submit" class="adm-btn-primary w-full h-11">Cập nhật sản phẩm</button>
                </form>
                <a href="./index.php" class="adm-btn-secondary w-full h-11 mt-4 text-center">Quay lại trang</a>
            </div>
        </main>
    </div>

    <?php include __DIR__ . '/components/toast-init.php'; ?>
</body>

</html>
