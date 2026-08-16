<?php

class Order_detail
{
    private $modelHangChiTiet;
    private $modelKhachHang;


    public function __construct()
    {
        $this->modelHangChiTiet = new Model_order_detel();
        $this->modelKhachHang = new Model_khach_hang();
    }
    public function index()
    {
        checkLogin();

        $id = (int)($_GET['id'] ?? 0);

        if ($id <= 0) {
            die("ID đơn hàng không hợp lệ");
        }

        $don_hang = $this->modelHangChiTiet->data_order_detel($id);

        $trangThai = $this->modelHangChiTiet->dataTrangThai();

        $thongTin = $this->modelKhachHang->data_khach_hang($id);

        // echo "<pre>";
        // print_r($thongTin);
        // echo "</pre>";
        // die();

        $order_messages = $this->modelHangChiTiet->message($id);

        $message = $order_messages['message'] ?? '';



        $mainFlow = [
            1 => [2, 6],
            2 => [3, 6],
            3 => [4, 6],
            4 => [5],
        ];
        $returnFlow = [
            5 => [7],
            7 => [8],
        ];
        $modelSanPham = new Data_san_pham();
        $listProductDelete = $modelSanPham->getAllDelete();
        require __DIR__ . '/../views/order_detail.php';
    }
    public function delete()
    {
        $id = $_GET['id'] ?? '';
        $model = new Model_order_detel;
        $model->model_delete($id);
        header("Location: index.php?controller=order_detail&action=index");
        exit();
    }
    public function search()
    {
        $keyword = trim($_GET['keyword'] ?? '');
        $model = new Model_order_detel;
        $don_hang =  $model->model_search($keyword);
        $modelSanPham = new Data_san_pham();
        $listProductDelete = $modelSanPham->getAllDelete();
        require __DIR__ . '/../views/order_detail.php';
    }
    public function approve_orders()
    {
        checkLogin();

        $idTrangThai = (int) ($_POST['trangThai'] ?? 0);
        $iddon = (int) ($_GET['iddon'] ?? 0);
        $message = trim($_POST['message'] ?? '');

        if ($iddon <= 0) {
            $_SESSION['msg'] = 'Đơn hàng không hợp lệ.';
            $_SESSION['type'] = 'danger';
            header('Location: index.php?controller=order_detail&action=index');
            exit();
        }

        if ($idTrangThai <= 0) {
            $_SESSION['msg'] = 'Trạng thái không hợp lệ.';
            $_SESSION['type'] = 'danger';
            header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? 'index.php?controller=order_detail&action=index'));
            exit();
        }

        if ($message !== '' && mb_strlen($message) > 1000) {
            $_SESSION['msg'] = 'Tin nhắn quá dài.';
            $_SESSION['type'] = 'danger';
            header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? 'index.php?controller=order_detail&action=index'));
            exit();
        }

        $order = $this->modelKhachHang->find_khach_hang($iddon);
        if (!$order) {
            $_SESSION['msg'] = 'Đơn hàng không tồn tại.';
            $_SESSION['type'] = 'danger';
            header('Location: index.php?controller=order_detail&action=index');
            exit();
        }

        $order_id = $order['order_id'];
        $user_id = $order['user_id'];

        $result = $this->modelHangChiTiet->modelDuyetDon($idTrangThai, $iddon);

        if ($result) {

            switch ($idTrangThai) {

                case 2:
                    $_SESSION['msg'] = 'Đơn hàng đã được xác nhận.';
                    break;

                case 3:
                    $_SESSION['msg'] = 'Đơn hàng đã chuyển sang trạng thái chuẩn bị hàng.';
                    break;

                case 4:
                    $_SESSION['msg'] = 'Đơn hàng đã chuyển sang trạng thái đang giao hàng.';
                    break;

                case 5:
                    $_SESSION['msg'] = 'Đơn hàng đã được giao thành công.';
                    break;

                case 7:
                    $_SESSION['msg'] = 'Shop đã hủy đơn hàng.';
                    break;

                case 10:
                    $_SESSION['msg'] = 'Shop đã xác nhận yêu cầu hoàn hàng.';
                    break;

                case 11:
                    $_SESSION['msg'] = 'Hoàn hàng thành công.';
                    break;

                default:
                    $_SESSION['msg'] = 'Cập nhật trạng thái thành công.';
                    break;
            }

            $_SESSION['type'] = 'success';
        } else {

            $_SESSION['msg'] = 'Không thể chuyển sang trạng thái này!';
            $_SESSION['type'] = 'error';
        }
        if ($message !== '') {
            $kq =  $this->modelHangChiTiet->insertMessage($order_id, $user_id, $message, 1);
            if (!$kq) {
                $_SESSION['msg'] = 'Không thể gửi tin nhắn!';
                $_SESSION['type'] = 'error';
            }
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
    // public function huyDon()
    // {
    //     $cancelOrder = $_POST['cancelOrder'] ?? '';
    //     $order_id = $_POST['order_id'] ?? '';
    //     $this->modelHangChiTiet->donchaynhat();
    // }
    public function thongKe()
    {
        $modelSanPham = new Data_san_pham();
        $listProductDelete = $modelSanPham->getAllDelete();
        // Lấy dữ liệu thống kê
        $data = $this->modelHangChiTiet->modelThongKe();

        // Lấy sản phẩm bán chạy nhất
        $hotNhat = $this->modelHangChiTiet->donchaynhat();

        // Gọi giao diện thống kê
        require_once __DIR__ . '/../views/doanhThu.php';
    }
}
