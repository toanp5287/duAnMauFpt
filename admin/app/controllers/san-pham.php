<?php

class San_pham

{

    private $modelSanPham;

    private $modelLoaiHang;



    /** Giới hạn số lượng hợp lý khi nhập từ form admin. */

    private const MAX_QUANTITY = 999999;



    public function __construct()

    {

        $this->modelSanPham = new Data_san_pham();

        $this->modelLoaiHang = new ModelLoaihang();

    }



    private function pdo(): ?PDO

    {

        return (new Database())->getConnection();

    }



    private function productRules(bool $isUpdate = false): array

    {

        $rules = [

            'ten_san_pham' => 'required|min:2|max:255',

            'gia'          => 'required|numeric|min_value:1',

            'so_luong'     => 'required|integer|min_value:0|max_value:' . self::MAX_QUANTITY,

            'mo_ta'        => 'nullable|max:50000',

        ];



        if ($isUpdate) {

            $rules['id'] = 'required|integer|min_value:1|exists:san_pham,id';

            $rules['loai_hang_id'] = 'required|integer|exists:loai_hang,id';

        } else {

            $rules['loai_hang'] = 'required|integer|exists:loai_hang,id';

        }



        return $rules;

    }



    private function productMessages(): array

    {

        return [

            'ten_san_pham.required' => 'Tên sản phẩm không được để trống.',

            'ten_san_pham.min'      => 'Tên sản phẩm không hợp lệ.',

            'ten_san_pham.max'      => 'Tên sản phẩm quá dài.',

            'gia.required'          => 'Giá không được để trống.',

            'gia.numeric'           => 'Giá sản phẩm phải là số.',

            'gia.min_value'         => 'Giá sản phẩm phải lớn hơn 0.',

            'so_luong.required'     => 'Số lượng không được để trống.',

            'so_luong.integer'      => 'Số lượng phải là số nguyên.',

            'so_luong.min_value'    => 'Số lượng không được nhỏ hơn 0.',

            'so_luong.max_value'    => 'Số lượng vượt quá giới hạn cho phép.',

            'mo_ta.max'             => 'Mô tả quá dài.',

            'loai_hang.required'    => 'Vui lòng chọn danh mục.',

            'loai_hang.integer'     => 'Vui lòng chọn danh mục.',

            'loai_hang.exists'      => 'Danh mục không tồn tại.',

            'loai_hang_id.required' => 'Vui lòng chọn danh mục.',

            'loai_hang_id.integer'  => 'Vui lòng chọn danh mục.',

            'loai_hang_id.exists'   => 'Danh mục không tồn tại.',

            'id.required'           => 'Sản phẩm không hợp lệ.',

            'id.integer'            => 'Sản phẩm không hợp lệ.',

            'id.min_value'          => 'Sản phẩm không hợp lệ.',

            'id.exists'             => 'Sản phẩm không tồn tại.',

        ];

    }



    private function countRows(string $sql, array $bindings): ?int

    {

        $pdo = $this->pdo();

        if (!$pdo instanceof PDO) {

            return null;

        }



        try {

            $stmt = $pdo->prepare($sql);

            $stmt->execute($bindings);



            return (int) $stmt->fetchColumn();

        } catch (Throwable $e) {

            return null;

        }

    }



    private function productHasRelations(int $productId): bool

    {

        $checks = [

            ['SELECT COUNT(*) FROM order_details WHERE san_pham_id = :id', [':id' => $productId]],

            ['SELECT COUNT(*) FROM giohang_chi_tiet WHERE san_pham_id = :id', [':id' => $productId]],

            ['SELECT COUNT(*) FROM danh_gia WHERE san_pham_id = :id', [':id' => $productId]],

        ];



        foreach ($checks as [$sql, $bindings]) {

            $count = $this->countRows($sql, $bindings);

            if ($count !== null && $count > 0) {

                return true;

            }

        }



        return false;

    }



    private function validateProductId($id): ?int

    {

        $validator = Validator::make(

            ['id' => $id],

            ['id' => 'required|integer|min_value:1|exists:san_pham,id'],

            $this->productMessages(),

            $this->pdo()

        );



        if ($validator->fails()) {

            return null;

        }



        return (int) $id;

    }



    public function index()

    {

        checkLogin();

        $product = $this->modelSanPham->ModelSanPham();

        require __DIR__ . '/../views/index-product.php';

    }



    public function create()

    {

        checkLogin();

        $list_loai = $this->modelLoaiHang->loaiHang();

        $errors = form_get_errors();



        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $pdo = $this->pdo();

            $validator = Validator::make($_POST, $this->productRules(false), $this->productMessages(), $pdo);



            if ($validator->fails()) {

                Validator::flashInput($_POST);

                form_set_errors($validator->errorsFlat());

                $errors = form_get_errors();

                require __DIR__ . '/../views/create.php';

                return;

            }



            $ten_san_pham = trim($_POST['ten_san_pham'] ?? '');

            $gia = (float) ($_POST['gia'] ?? 0);

            $soluong = (int) ($_POST['so_luong'] ?? 0);

            $mota = $_POST['mo_ta'] ?? '';

            $loaihang = (int) ($_POST['loai_hang'] ?? 0);

            $hinhanh = '';

            $upload_dir = __DIR__ . '/../../public/uploads/';
            [$uploadOk, $uploadError, $storedName] = upload_store_image(
                $_FILES,
                ['hinh_anh', 'hinh anh'],
                $upload_dir,
                false
            );

            if (!$uploadOk) {
                Validator::flashInput($_POST);
                form_set_errors(['hinh_anh' => $uploadError]);
                $errors = form_get_errors();
                require __DIR__ . '/../views/create.php';
                return;
            }

            if ($storedName !== '') {
                $hinhanh = $storedName;
            }



            $this->modelSanPham->model_creat($ten_san_pham, $gia, $soluong, $mota, $loaihang, $hinhanh);

            form_flash_success('Thêm sản phẩm thành công.');

            header("Location: index.php?controller=san_pham&action=index");

            exit();

        }



        require __DIR__ . '/../views/create.php';

    }



    public function delete()

    {

        checkLogin();



        $productId = $this->validateProductId($_GET['id'] ?? '');

        if ($productId === null) {

            form_flash_error('Sản phẩm không tồn tại.');

            header("Location: index.php?controller=san_pham&action=index");

            exit();

        }



        if ($this->productHasRelations($productId)) {

            form_flash_error('Không thể xóa sản phẩm này.');

            header("Location: index.php?controller=san_pham&action=index");

            exit();

        }



        $product = $this->modelSanPham->find($productId);

        if ($product && !empty($product['hinh_anh'])) {

            @unlink(__DIR__ . '/../../public/uploads/' . $product['hinh_anh']);

        }



        $this->modelSanPham->model_delete($productId);

        form_flash_success('Xóa sản phẩm thành công.');

        header("Location: index.php?controller=san_pham&action=index");

        exit();

    }



    public function update()

    {

        checkLogin();



        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $pdo = $this->pdo();

            $validator = Validator::make($_POST, $this->productRules(true), $this->productMessages(), $pdo);



            if ($validator->fails()) {

                Validator::flashInput($_POST);

                form_set_errors($validator->errorsFlat());

                $errors = form_get_errors();

                $id = (int) ($_POST['id'] ?? 0);

                $san_pham_update = $this->modelSanPham->find($id) ?: [];

                $list_loai = $this->modelLoaiHang->loaiHang();

                require __DIR__ . '/../views/update.php';

                return;

            }



            $id = (int) ($_POST['id'] ?? 0);

            $ten_san_pham = trim($_POST['ten_san_pham'] ?? '');

            $gia = (float) ($_POST['gia'] ?? 0);

            $soluong = (int) ($_POST['so_luong'] ?? 0);

            $mota = $_POST['mo_ta'] ?? '';

            $loaihang = (int) ($_POST['loai_hang_id'] ?? 0);



            $sanPham = $this->modelSanPham->find($id);

            if (!$sanPham) {

                form_flash_error('Sản phẩm không tồn tại.');

                header("Location: index.php?controller=san_pham&action=index");

                exit();

            }



            $hinhanh = $sanPham['hinh_anh'];

            if (upload_resolve_file($_FILES, ['hinh_anh', 'hinh anh']) !== null) {
                $upload_dir = __DIR__ . '/../../public/uploads/';
                [$uploadOk, $uploadError, $storedName] = upload_store_image(
                    $_FILES,
                    ['hinh_anh', 'hinh anh'],
                    $upload_dir,
                    false
                );

                if (!$uploadOk) {
                    Validator::flashInput($_POST);
                    form_set_errors(['hinh_anh' => $uploadError]);
                    $errors = form_get_errors();
                    $san_pham_update = $sanPham;
                    $list_loai = $this->modelLoaiHang->loaiHang();
                    require __DIR__ . '/../views/update.php';
                    return;
                }

                if ($storedName !== '') {
                    @unlink($upload_dir . $hinhanh);
                    $hinhanh = $storedName;
                }
            }



            $this->modelSanPham->model_update($id, $ten_san_pham, $gia, $soluong, $mota, $loaihang, $hinhanh);

            form_flash_success('Cập nhật sản phẩm thành công.');

            header("Location: index.php?controller=san_pham&action=index");

            exit();

        }



        $productId = $this->validateProductId($_GET['id'] ?? '');

        if ($productId === null) {

            form_flash_error('Sản phẩm không tồn tại.');

            header("Location: index.php?controller=san_pham&action=index");

            exit();

        }



        $san_pham_update = $this->modelSanPham->find($productId);

        $list_loai = $this->modelLoaiHang->loaiHang();

        $errors = form_get_errors();

        require __DIR__ . '/../views/update.php';

    }

}


