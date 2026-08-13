    
<?php

class Shopping_cart
{
    private $modelShoping;

    public function __construct()
    {
        $this->modelShoping = new Model_shopping();
    }

    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header("Location:index.php?controller=login");
            exit();
        }

        $user_id = (int) $_SESSION['user']['id'];

        $gio_hang = $this->modelShoping->modelGioHang($user_id);


        require __DIR__ . '/../views/cart.php';
    }

    public function updateSoLuong()
    {
        if (!isset($_SESSION['user'])) {
            header("Location:index.php?controller=login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location:index.php?controller=shopping_cart&action=index");
            exit();
        }

        $user_id = (int) $_SESSION['user']['id'];

        $id = (int) ($_POST['id'] ?? 0);
        $giohang_id = (int) ($_POST['giohang_id'] ?? 0);
        $san_pham_id = (int) ($_POST['san_pham_id'] ?? 0);
        $so_luong = max(1, (int) ($_POST['so_luong'] ?? 1));

        $result = $this->modelShoping->modelUpdateSoLuong(
            $id,
            $giohang_id,
            $san_pham_id,
            $so_luong,
            $user_id
        );

        if ($result) {
            $this->modelShoping->syncGioHangTotals($giohang_id);
        }

        header("Location:index.php?controller=shopping_cart&action=index");
        exit();
    }

    public function delete_gio_hang()
    {
        if (!isset($_SESSION['user'])) {
            header("Location:index.php?controller=login");
            exit();
        }

        $id = (int) ($_GET['id'] ?? 0);
        $user_id = (int) $_SESSION['user']['id'];

        $giohang_id = $this->modelShoping->delete_cart($id, $user_id);

        if ($giohang_id) {
            $this->modelShoping->syncGioHangTotals($giohang_id);
        }

        header("Location:index.php?controller=shopping_cart&action=index");
        exit();
    }
    public function sacNhan()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $idDon = $_POST['idDon'] ?? 0;

            $this->modelShoping->modelSacNhan($idDon);

            header("Location: " . ($_SERVER['HTTP_REFERER'] ?? 'index.php'));
            exit();
        }
    }
    public function huyDon()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idDon = $_POST['idDon'];
            $order = $this->modelShoping->find_khach_hang($idDon);
            // print_r($order);
            // die();
            $order_id = $order['order_id'];

            $user_id = $order['user_id'];
            $message = $_POST['message'] ?? '';
            $message = $_POST['message'] ?? '';
            if ($message !== '') {
                $kq =  $this->modelShoping->insertMessage($order_id, $user_id, $message, 1);
                if (!$kq) {
                    $_SESSION['msg'] = 'Không thể gửi tin nhắn!';
                    $_SESSION['type'] = 'error';
                }
            }
            if ($this->modelShoping->modelHuyDon($idDon)) {

                echo "<script>
            alert('da huy thành công');
            window.location.href='index.php?controller=login&action=lichSu';
        </script>";
                exit();
            } else {
                echo "Không thể hủy đơn hàng!";
            }
        }
    }
    public function hoanHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idDon = $_POST['idDon'];
            $order = $this->modelShoping->find_khach_hang($idDon);
            // print_r($order);
            // die();
            $order_id = $order['order_id'];

            $user_id = $order['user_id'];
            $message = $_POST['message'] ?? '';
            $message = $_POST['message'] ?? '';
            if ($message !== '') {
                $kq =  $this->modelShoping->insertMessage($order_id, $user_id, $message, 1);
                if (!$kq) {
                    $_SESSION['msg'] = 'Không thể gửi tin nhắn!';
                    $_SESSION['type'] = 'error';
                }
            }
            if ($this->modelShoping->modelHoanHang($idDon)) {

                echo "<script>
            alert('da gui yêu cầu hoàn hàng');
          window.location.href='index.php?controller=login&action=lichSu    ';
        </script>";
                exit();
            } else {
                echo "Không thể hủy đơn hàng!";
            }
        }
    }
    public function chiTietDonHang()
    {
        $id = $_GET['id'] ?? '';
        $donHang  = $this->modelShoping->modelChiTietDOnHang($id);

        require_once __DIR__ . '/../views/chiTietDonHang.php';
    }
}
