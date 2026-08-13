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
        $id = (int)($_GET['id'] ?? 0);

        $list_san_pham = $this->modelChiTiet->chi_tiet($id);

        $id_loai_hang = $list_san_pham['loai_hang_id'] ?? 0;
        $related_products =  $this->modelCategory->phan_loai($id, $id_loai_hang) ?? [];
        $reviews = $this->modelRV->modelGetAllReview($id);
        require __DIR__ . '/../views/product.php';
    }

    public function them_gio_hang()
    {
        // if (!isset($_SESSION['user']['id'])) {
        //     header("Location:index.php?controller=login");
        //     exit();
        // }

        // $user_id = (int)$_SESSION['user']['id'];
        // $san_pham_id = (int)($_GET['id'] ?? 0);

        // if ($san_pham_id <= 0) {
        //     header("Location:index.php");
        //     exit();
        // }

        // $model = new Model_shopping();
        // $gioHang = $model->findGioHangByUser($user_id);

        // if (!$gioHang) {
        //     $giohang_id = $model->insertGioHang($user_id);
        // } else {
        //     $giohang_id = (int)$gioHang['id'];
        // }

        // $chiTiet = $model->findChiTietGioHang($giohang_id, $san_pham_id);

        // if ($chiTiet) {
        //     $model->updateSoLuong((int)$chiTiet['id']);
        // } else {
        //     $model->insertGioHangChiTiet($giohang_id, $san_pham_id, 1);
        // }

        // $model->syncGioHangTotals($giohang_id);

        // header("Location:index.php?controller=san_pham&action=index");
        // exit();
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?controller=login");
            exit();
        }
        $user_id = (int)$_SESSION['user']['id'];
        $san_pham_id = (int)($_GET['id'] ?? 0);
        if ($san_pham_id <= 0) {
            header("Location: index.php");
            exit();
        }
        $model = new Model_shopping;
        $gioHang = $model->findGioHangByUser($user_id);
        if (!$gioHang) {
            $giohang_id =  $model->insertGioHang($user_id);
        } else {
            $giohang_id =  (int)$gioHang['id'];
        }
        $chiTiet = $model->findChiTietGioHang($giohang_id, $san_pham_id);
        if ($chiTiet) {
            $model->updateSoLuong((int)$chiTiet['id']);
        } else {
            $model->insertGioHangChiTiet($giohang_id, $san_pham_id, 1);
        }
        $model->syncGioHangTotals($giohang_id);
        header("Location: index.php?controller=san_pham&action=index");
        exit();
    }

    /** Giữ route cũ: chuyển sang shopping_cart */
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
        $user = $_SESSION['user']['id'];
        if (!isset($user)) {
            echo "<script>
        alert('can dang nhap de su dung tinh nang danh gia!');
        window.location.href='index.php?controller=login&action=index';
    </script>";
            exit;
        }
        $id_sp = $_POST['id_sp'] ?? 0;
        $so_sao = $_POST['so_sao'] ?? 0;
        $danhGia = $_POST['danhGia'] ?? '';

        $this->modelRV->insertReview(
            $id_sp,
            $user,
            $so_sao,
            $danhGia
        );
        echo "<script>
alert('Cảm ơn bạn đã đánh giá!');
window.location.href='index.php?controller=chi_tiet&action=index&id=$id_sp';
</script>";
        exit;
    }
}
