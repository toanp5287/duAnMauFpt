
<?php

class Khach_hang
{
    private $modelKhachHang;

    public function __construct()
    {
        $this->modelKhachHang = new Model_khach_hang();
    }

    public function index()
    {
        // Số đơn mỗi trang
        $limit = 10;

        // Trang hiện tại
        $page = isset($_GET['page'])
            ? max(1, (int)$_GET['page'])
            : 1;


        // Lấy danh sách đơn hàng
        $khach_hang = $this->modelKhachHang->data_khach_hang(
            null,
            $page,
            $limit
        );


        // Tổng số đơn hàng
        $totalOrders = $this->modelKhachHang->count_khach_hang();


        // Tổng số trang
        $totalPages = ceil($totalOrders / $limit);
        $modelSanPham = new Data_san_pham();
        $listProductDelete = $modelSanPham->getAllDelete();

        require_once __DIR__ . '/../views/khach-hang.php';
    }
    // public function delete()
    // {
    //     $model = new Model_khach_hang;
    //     $id = $_GET['id'] ?? '';
    //     $model->model_delete($id);
    //     header("Location: index.php?controller=khach_hang&action=index");
    //     exit();
    // }
    // public function update_khach_hang()
    // {
    //     $model = new Model_khach_hang;
    //     if ($_SERVER['REQUEST_METHOD'] == "POST") {

    //         $id = $_POST['id'] ?? '';
    //         $user_id = $_POST['user_id'] ?? '';
    //         $trang_thai = $_POST['trang_thai'] ?? '';
    //         $ten_khach_hang = $_POST['ten_khach_hang'] ?? '';
    //         $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
    //         $dia_chi = $_POST['dia_chi'] ?? '';
    //         $cach_thanh_toan = $_POST['cach_thanh_toan'] ?? '';
    //         $ghi_chu = trim($_POST['ghi_chu']) ?? '';
    //         $tong_tien = $_POST['tong_tien'] ?? '';
    //         $created_at = $_POST['created_at'] ?? '';
    //         if (!preg_match('/^0[0-9]{9,10}$/', $so_dien_thoai)) {

    //             $errol = "so dien thoai khong hop le";

    //             $khach_hang_limit = $model->find_khach_hang($id);

    //             require __DIR__ . '/../views/update_khach_hang.php';

    //             return;
    //         }
    //         $model->model_update(
    //             $id,
    //             $user_id,
    //             $trang_thai,
    //             $ten_khach_hang,
    //             $so_dien_thoai,
    //             $dia_chi,
    //             $cach_thanh_toan,
    //             $ghi_chu,
    //             $tong_tien,
    //             $created_at
    //         );
    //         header("Location: index.php?controller=khach_hang&action=index");
    //         exit();
    //     }
    //     $id = $_GET['id'] ?? '';
    //     $khach_hang_limit = $model->find_khach_hang($id);
    //     require __DIR__ . '/../views/update_khach_hang.php';
    // }
}
