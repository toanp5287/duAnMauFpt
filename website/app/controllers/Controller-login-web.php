<?php

class Login
{
    private $userModel;
    private $modelShoping;

    public function __construct()
    {
        $this->userModel = new Model_login_khach_hang();
        $this->modelShoping = new Model_shopping();
    }

    // Hàm này CHỈ ĐỂ hiện giao diện form trống
    public function index()
    {
        require __DIR__ . '/../views/login-web.php';
    }

    // ĐỔI TÊN HÀM THÀNH: xu_ly_dang_nhap
    public function xu_ly_dang_nhap()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = isset($_POST['email']) ? trim($_POST['email']) : '';
            $password = isset($_POST['password']) ? trim($_POST['password']) : '';


            $user_data = $this->userModel->login_khach_hang($email, $password);
            if ($user_data) {
                $_SESSION['user'] = $user_data;
                header("Location: index.php?controller=san_pham&action=index");
                exit;
            } else {
                $error = "Email hoặc mật khẩu không chính xác!";
                // Nạp lại view kèm thông báo lỗi
                require __DIR__ . '/../views/login-web.php';
            }
        }
    }
    public function dang_ky()
    {
        require __DIR__ . '/../Views/dang-ky-web.php';
    }
    public function xu_ly_dang_ky()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $name = isset($_POST['name'])
                ? trim($_POST['name'])
                : '';

            $email = isset($_POST['email'])
                ? trim($_POST['email'])
                : '';

            $phone = isset($_POST['phone'])
                ? trim($_POST['phone'])
                : '';

            $password = isset($_POST['password'])
                ? trim($_POST['password'])
                : '';

            $role = 0;

            // validate rỗng
            if (
                empty($name) ||
                empty($email) ||
                empty($phone) ||
                empty($password)
            ) {

                $error = "Không được để trống dữ liệu";

                require __DIR__ . '/../Views/dang-ky-web.php';

                return;
            }

            // validate email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

                $error = "Email không hợp lệ";

                require __DIR__ . '/../Views/dang-ky-web.php';

                return;
            }

            // validate phone
            if (!preg_match('/^0[0-9]{9,10}$/', $phone)) {

                $error = "Số điện thoại không hợp lệ";
                require __DIR__ . '/../Views/dang-ky-web.php';

                return;
            }

            // validate password
            if (strlen($password) < 6) {

                $error = "Mật khẩu phải >= 6 ký tự";
                require __DIR__ . '/../Views/dang-ky-web.php';

                return;
            }

            // gọi model
            $result = $this->userModel->data_dang_ky_khach_hang(
                $name,
                $email,
                $password,
                $phone,
                $role
            );

            if ($result) {

                header("Location: index.php?controller=login&action=index");
                exit;
            } else {

                $error = "tài khoản bị trùng dăng ký thất bại";

                require __DIR__ . '/../views/dang-ky-web.php';
            }
        }
    }
    public function logout()
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        header("Location: index.php?controller=san_pham&action=index");
        exit;
    }
    public function controllerGETuser()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?contrller=login");
            exit;
        }
        $idUser = $_SESSION['user']['id'];

        $user =   $this->userModel->modelDataUser($idUser);
        $lich_su_don = $this->modelShoping->data_shopping($idUser);
        require __DIR__ . '/../views/thongTinUser.php';
    }
    public function lichSu()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?contrller=login");
            exit;
        }
        $idUser = $_SESSION['user']['id'];
        $lich_su_don = $this->modelShoping->data_shopping($idUser);
        // echo "<pre>";
        // print_r($lich_su_don);
        // echo "</pre>";
        // die();
        require __DIR__ . '/../views/lichSUdon.php';
    }
    public function controllerUpateUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $idUser = $_SESSION['user']['id'];
            $this->userModel->updateUser($name, $email, $phone, $idUser);
            echo "<script>
        alert('cap nhat thành công!');
        window.location.href='index.php?controller=san_pham';
    </script>";
            exit();
        }
    }
    public function updateMKuser()
    {
        $idUser = $_SESSION['user']['id'];

        $errolcurrentPassword = '';
        $errolConfirmPassword = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $currentPassword = $_POST['currentPassword'] ?? '';
            $newPassword = $_POST['newPassword'] ?? '';
            $ConfirmPassword = $_POST['ConfirmPassword'] ?? '';

            // 1. Kiểm tra mật khẩu hiện tại
            if (!$this->userModel->findPassword($currentPassword, $idUser)) {
                $errolcurrentPassword = 'Mật khẩu hiện tại không đúng';
                echo    $errolcurrentPassword;
            }

            // 2. Kiểm tra mật khẩu mới và xác nhận
            if ($newPassword !== $ConfirmPassword) {
                $errolConfirmPassword = 'Xác nhận mật khẩu không đúng';
            }

            // 3. Nếu tất cả đều đúng thì đổi mật khẩu
            if (
                $errolcurrentPassword === '' &&
                $errolConfirmPassword === ''
            ) {

                $result = $this->userModel->updateMK(
                    $newPassword,
                    $idUser
                );

                if ($result) {
                    echo "<script>
                    alert('Đổi mật khẩu thành công!');
                    window.location.href='index.php?controller=login&action=controllerGETuser';
                </script>";
                    exit();
                }
            }
        }
    }
    public function viuUpdatemkUser()
    {
        require __DIR__ . '/../views/updateMK.php';
    }
}
