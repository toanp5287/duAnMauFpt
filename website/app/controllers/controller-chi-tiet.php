<?php

class Chitiet
{
    private $modelChiTiet;
    private $modelCategory;
    private $modelRV;

    public function __construct()
    {
        $this->modelChiTiet = new Model_chi_tiet();
        $this->modelCategory = new Model_category();
        $this->modelRV = new ModelReview();
    }

    public function index()
    {
        $id = (int) ($_GET['id'] ?? 0);

        $list_san_pham = $this->modelChiTiet->chi_tiet($id);

        $id_loai_hang = $list_san_pham['loai_hang_id'] ?? 0;
        $related_products = $this->modelCategory->phan_loai($id, $id_loai_hang) ?? [];
        $reviews = $this->modelRV->modelGetAllReview($id);
        $errors = form_get_errors();
        $reviewSuccess = form_success_message();

        require __DIR__ . '/../views/product.php';
    }

    public function them_gio_hang()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?controller=login");
            exit();
        }

        $user_id = (int) $_SESSION['user']['id'];
        $san_pham_id = (int) ($_GET['id'] ?? 0);

        if ($san_pham_id <= 0) {
            Validator::flashErrors(['cart' => 'Sản phẩm không tồn tại.']);
            header("Location: index.php");
            exit();
        }

        $sp = $this->modelChiTiet->chi_tiet($san_pham_id);
        if (!$sp) {
            Validator::flashErrors(['cart' => 'Sản phẩm không tồn tại.']);
            header("Location: index.php");
            exit();
        }

        if ((int) ($sp['so_luong'] ?? 0) < 1) {
            Validator::flashErrors(['cart' => 'Không thể đặt hàng vì sản phẩm ' . ($sp['ten_san_pham'] ?? '') . ' đã hết hàng.']);
            header("Location: index.php?controller=chi_tiet&action=index&id=" . $san_pham_id);
            exit();
        }

        $model = new Model_shopping();
        $gioHang = $model->findGioHangByUser($user_id);
        if (!$gioHang) {
            $giohang_id = $model->insertGioHang($user_id);
        } else {
            $giohang_id = (int) $gioHang['id'];
        }

        $chiTiet = $model->findChiTietGioHang($giohang_id, $san_pham_id);
        if ($chiTiet) {
            $newQty = (int) $chiTiet['so_luong'] + 1;
            if ($newQty > (int) $sp['so_luong']) {
                Validator::flashErrors(['cart' => 'Số lượng sản phẩm vượt quá tồn kho.']);
                header("Location: index.php?controller=chi_tiet&action=index&id=" . $san_pham_id);
                exit();
            }
            $model->modelUpdateSoLuong(
                (int) $chiTiet['id'],
                $giohang_id,
                $san_pham_id,
                $newQty,
                $user_id
            );
        } else {
            $model->insertGioHangChiTiet($giohang_id, $san_pham_id, 1);
        }

        $model->syncGioHangTotals($giohang_id);
        header("Location: index.php?controller=san_pham&action=index");
        exit();
    }

    public function updateSoLuong()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/controller-shopping-cart.php';
            $cart = new Shopping_cart();
            $cart->updateSoLuong();
            return;
        }

        header("Location:index.php?controller=shopping_cart&action=index");
        exit();
    }

    public function insertRV()
    {
        if (!isset($_SESSION['user']['id'])) {
            Validator::flashErrors(['auth' => 'Bạn cần đăng nhập để đánh giá sản phẩm.']);
            header("Location: index.php?controller=login&action=index");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php");
            exit;
        }

        unset($_POST['user_id']);

        $user = (int) $_SESSION['user']['id'];
        $id_sp = (int) ($_POST['id_sp'] ?? 0);

        $pdo = (new Database())->getConnection();
        $validator = Validator::make($_POST, [
            'id_sp'   => 'required|integer|min_value:1|exists:san_pham,id',
            'so_sao'  => 'required|integer|in:1,2,3,4,5',
            'danhGia' => 'required|min:10|max:2000',
        ], [
            'so_sao.required'  => 'Vui lòng chọn số sao.',
            'so_sao.integer'   => 'Số sao phải từ 1 đến 5.',
            'so_sao.in'        => 'Số sao phải từ 1 đến 5.',
            'danhGia.required' => 'Nội dung đánh giá không được để trống.',
            'danhGia.min'      => 'Nội dung đánh giá phải có ít nhất 10 ký tự.',
            'id_sp.exists'     => 'Sản phẩm không tồn tại.',
        ], $pdo);

        if ($validator->fails()) {
            Validator::flashInput($_POST, ['user_id']);
            Validator::flashErrors($validator->errorsFlat());
            header("Location: index.php?controller=chi_tiet&action=index&id=" . $id_sp);
            exit;
        }

        $so_sao = (int) ($_POST['so_sao'] ?? 0);
        $danhGia = trim($_POST['danhGia'] ?? '');

        $this->modelRV->insertReview($id_sp, $user, $so_sao, $danhGia);

        form_flash_success('Đánh giá của bạn đã được gửi.');
        header("Location: index.php?controller=chi_tiet&action=index&id=" . $id_sp);
        exit;
    }
}
