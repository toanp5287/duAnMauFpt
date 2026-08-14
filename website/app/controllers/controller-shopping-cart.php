    
<?php

class Shopping_cart
{
    private $modelShoping;
    private $san_pham;
    public function __construct()
    {
        $this->modelShoping = new Model_shopping();
        $this->san_pham = new Model_chi_tiet;
    }

    /**
     * @return array<string, mixed>|null
     */
    private function getOwnedOrder(int $orderId): ?array
    {
        if (!isset($_SESSION['user']['id']) || $orderId <= 0) {
            return null;
        }

        $order = $this->modelShoping->find_khach_hang($orderId);
        if (!$order || (int) ($order['user_id'] ?? 0) !== (int) $_SESSION['user']['id']) {
            return null;
        }

        return $order;
    }

    private function redirectOrderHistory(string $message = ''): void
    {
        if ($message !== '') {
            Validator::flashErrors(['cart' => $message]);
        }
        header('Location: index.php?controller=login&action=lichSu');
        exit();
    }

    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header("Location:index.php?controller=login");
            exit();
        }

        $user_id = (int) $_SESSION['user']['id'];
        $gio_hang = $this->modelShoping->modelGioHang($user_id);

        $errors = form_get_errors();

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
        $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
            || (strpos($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json') !== false);

        $validator = Validator::make($_POST, [
            'id'        => 'required|integer|min_value:1',
            'so_luong'  => 'required|integer|min_value:1',
        ], [
            'id.required'       => 'Mục giỏ hàng không hợp lệ.',
            'so_luong.required' => 'Số lượng không hợp lệ.',
            'so_luong.integer'  => 'Số lượng phải là số nguyên.',
            'so_luong.min_value' => 'Số lượng phải lớn hơn 0.',
        ]);

        if ($validator->fails()) {
            $message = $validator->first('so_luong') ?? $validator->first('id') ?? 'Dữ liệu không hợp lệ.';
            $fieldKey = $validator->first('so_luong') ? ('qty_item_' . (int) ($_POST['id'] ?? 0)) : 'cart';
            if ($isAjax) {
                header('Content-Type: application/json');
                echo json_encode([
                    'status'  => 'error',
                    'message' => $message,
                    'field'   => $fieldKey,
                ]);
                exit();
            }
            Validator::flashErrors([$fieldKey => $message]);
            header("Location:index.php?controller=shopping_cart&action=index");
            exit();
        }

        $id = (int) ($_POST['id'] ?? 0);
        $so_luong = (int) ($_POST['so_luong'] ?? 1);

        $gio_hang = $this->modelShoping->modelGioHang($user_id);
        $cartRow = null;
        foreach ($gio_hang as $row) {
            if ((int) $row['id'] === $id) {
                $cartRow = $row;
                break;
            }
        }

        if (!$cartRow) {
            $message = 'Không tìm thấy sản phẩm trong giỏ hàng.';
            $fieldKey = 'qty_item_' . $id;
            if ($isAjax) {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'error', 'message' => $message, 'field' => $fieldKey]);
                exit();
            }
            Validator::flashErrors([$fieldKey => $message]);
            header("Location:index.php?controller=shopping_cart&action=index");
            exit();
        }

        $modelBy = new Model_by();
        $sp = $modelBy->find((int) $cartRow['san_pham_id']);
        if (!$sp) {
            $message = 'Sản phẩm không tồn tại.';
            $fieldKey = 'qty_item_' . $id;
            if ($isAjax) {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'error', 'message' => $message, 'field' => $fieldKey]);
                exit();
            }
            Validator::flashErrors([$fieldKey => $message]);
            header("Location:index.php?controller=shopping_cart&action=index");
            exit();
        }

        $stock = (int) ($sp['so_luong'] ?? 0);
        if ($stock < 1) {
            $message = 'Không thể đặt hàng vì sản phẩm ' . ($sp['ten_san_pham'] ?? '') . ' đã hết hàng.';
            $fieldKey = 'qty_item_' . $id;
            if ($isAjax) {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'error', 'message' => $message, 'field' => $fieldKey]);
                exit();
            }
            Validator::flashErrors([$fieldKey => $message]);
            header("Location:index.php?controller=shopping_cart&action=index");
            exit();
        }

        if ($so_luong > $stock) {
            $message = 'Số lượng sản phẩm vượt quá tồn kho.';
            $fieldKey = 'qty_item_' . $id;
            if ($isAjax) {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'error', 'message' => $message, 'field' => $fieldKey]);
                exit();
            }
            Validator::flashErrors([$fieldKey => $message]);
            header("Location:index.php?controller=shopping_cart&action=index");
            exit();
        }

        $giohang_id = (int) $cartRow['giohang_id'];
        $san_pham_id = (int) $cartRow['san_pham_id'];

        $result = $this->modelShoping->modelUpdateSoLuong(
            $id,
            $giohang_id,
            $san_pham_id,
            $so_luong,
            $user_id
        );

        if ($result) {
            $this->modelShoping->syncGioHangTotals($giohang_id);
            if ($isAjax) {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'success']);
                exit();
            }
        } elseif ($isAjax) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Không thể cập nhật số lượng.']);
            exit();
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

        if ($id <= 0) {
            Validator::flashErrors(['cart' => 'Không tìm thấy sản phẩm trong giỏ hàng.']);
            header("Location:index.php?controller=shopping_cart&action=index");
            exit();
        }

        $giohang_id = $this->modelShoping->delete_cart($id, $user_id);

        if (!$giohang_id) {
            Validator::flashErrors(['cart' => 'Không tìm thấy sản phẩm trong giỏ hàng.']);
            header("Location:index.php?controller=shopping_cart&action=index");
            exit();
        }

        $this->modelShoping->syncGioHangTotals($giohang_id);

        header("Location:index.php?controller=shopping_cart&action=index");
        exit();
    }

    public function sacNhan()
    {
        if (!isset($_SESSION['user'])) {
            header("Location:index.php?controller=login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idDon = (int) ($_POST['idDon'] ?? 0);
            if (!$this->getOwnedOrder($idDon)) {
                $this->redirectOrderHistory('Không tìm thấy đơn hàng.');
            }

            $this->modelShoping->modelSacNhan($idDon);
            header("Location: " . ($_SERVER['HTTP_REFERER'] ?? 'index.php?controller=login&action=lichSu'));
            exit();
        }
    }

    public function huyDon()
    {
        if (!isset($_SESSION['user'])) {
            header("Location:index.php?controller=login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idDon = (int) ($_POST['idDon'] ?? 0);
            $order = $this->getOwnedOrder($idDon);
            if (!$order) {
                $this->redirectOrderHistory('Không tìm thấy đơn hàng.');
            }

            $order_id = $order['order_id'];
            $user_id = (int) $_SESSION['user']['id'];
            $message = trim($_POST['message'] ?? '');
            if ($message !== '' && mb_strlen($message) > 1000) {
                $this->redirectOrderHistory('Nội dung tin nhắn quá dài.');
            }

            if ($message !== '') {
                $kq = $this->modelShoping->insertMessage($order_id, $user_id, $message, 1);
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
            }

            echo "Không thể hủy đơn hàng!";
        }
    }

    public function hoanHang()
    {
        if (!isset($_SESSION['user'])) {
            header("Location:index.php?controller=login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idDon = (int) ($_POST['idDon'] ?? 0);
            $order = $this->getOwnedOrder($idDon);
            if (!$order) {
                $this->redirectOrderHistory('Không tìm thấy đơn hàng.');
            }

            $order_id = $order['order_id'];
            $user_id = (int) $_SESSION['user']['id'];
            $message = trim($_POST['message'] ?? '');
            if ($message !== '' && mb_strlen($message) > 1000) {
                $this->redirectOrderHistory('Nội dung tin nhắn quá dài.');
            }

            if ($message !== '') {
                $kq = $this->modelShoping->insertMessage($order_id, $user_id, $message, 1);
                if (!$kq) {
                    $_SESSION['msg'] = 'Không thể gửi tin nhắn!';
                    $_SESSION['type'] = 'error';
                }
            }
            if ($this->modelShoping->modelHoanHang($idDon)) {
                echo "<script>
            alert('da gui yêu cầu hoàn hàng');
          window.location.href='index.php?controller=login&action=lichSu';
        </script>";
                exit();
            }

            echo "Không thể hủy đơn hàng!";
        }
    }

    public function chiTietDonHang()
    {
        if (!isset($_SESSION['user'])) {
            header("Location:index.php?controller=login");
            exit();
        }

        $id = (int) ($_GET['id'] ?? 0);
        if (!$this->getOwnedOrder($id)) {
            $this->redirectOrderHistory('Không tìm thấy đơn hàng.');
        }

        $donHang = $this->modelShoping->modelChiTietDOnHang($id);
        // echo "<pre>";
        // print_r($donHang);
        // echo "</pre>";
        // die();
        require_once __DIR__ . '/../views/chiTietDonHang.php';
    }
    public function editDeliveryInformation()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $idOrder = (int)($_POST['order_id'] ?? 0);
            $phone = trim($_POST['phone'] ?? '');
            $address = trim($_POST['address'] ?? '');

            $result = $this->modelShoping->updateDiaChi(
                $idOrder,
                $phone,
                $address
            );

            if ($result) {
                header(
                    "Location: index.php?controller=shopping_cart&action=chiTietDonHang&id=" . $idOrder
                );
                exit;
            }
        }

        $idOrder = (int)($_GET['id'] ?? 0);

        $donHang = $this->modelShoping->modelChiTietDOnHang($idOrder);

        require_once __DIR__ . "/../views/updateDeliveryInformation.php";
    }
}
