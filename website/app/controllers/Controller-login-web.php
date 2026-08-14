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

    private function pdo(): ?PDO
    {
        $db = new Database();
        return $db->getConnection();
    }

    public function index()
    {
        $errors = form_get_errors();
        require __DIR__ . '/../views/login-web.php';
    }

    public function xu_ly_dang_nhap()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $validator = Validator::make($_POST, [
                'email'    => 'required|email|max:255',
                'password' => 'required|max:255',
            ], [
                'email.required'    => 'Vui lòng nhập email.',
                'password.required' => 'Vui lòng nhập mật khẩu.',
                'email.email'       => 'Email không đúng định dạng.',
            ]);

            if ($validator->fails()) {
                Validator::flashInput($_POST, ['password']);
                form_set_errors($validator->errorsFlat());
                require __DIR__ . '/../views/login-web.php';
                return;
            }

            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            $user_data = $this->userModel->login_khach_hang($email, $password);
            if ($user_data) {
                Validator::clearFlash();
                $_SESSION['user'] = $user_data;
                header("Location: index.php?controller=san_pham&action=index");
                exit;
            }

            Validator::flashInput($_POST, ['password']);
            form_set_errors(['auth' => 'Email hoặc mật khẩu không chính xác.']);
            require __DIR__ . '/../views/login-web.php';
        }
    }

    public function dang_ky()
    {
        $errors = form_get_errors();
        require __DIR__ . '/../views/dang-ky-web.php';
    }

    public function xu_ly_dang_ky()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $pdo = $this->pdo();

            $validator = Validator::make($_POST, [
                'name'             => ['required', 'min:2', 'max:100', 'regex:/^[\p{L}\s\'\.\-]+$/u'],
                'email'            => 'required|email|max:255|unique:users,email',
                'phone'            => 'required|phone',
                'password'         => 'required|min:6|max:255',
                'confirmPassword'  => 'required|same:password',
            ], [
                'name.required'            => 'Họ tên không được để trống.',
                'name.min'                 => 'Họ tên phải đúng định dạng.',
                'name.regex'               => 'Họ tên phải đúng định dạng.',
                'email.required'             => 'Email không được để trống.',
                'email.email'                => 'Email không đúng định dạng.',
                'email.unique'               => 'Email này đã được đăng ký.',
                'phone.required'             => 'Số điện thoại không được để trống.',
                'phone.phone'                => 'Số điện thoại không hợp lệ.',
                'password.required'          => 'Mật khẩu không được để trống.',
                'password.min'               => 'Mật khẩu phải có ít nhất 6 ký tự.',
                'password.max'               => 'Mật khẩu quá dài.',
                'confirmPassword.required'   => 'Vui lòng xác nhận mật khẩu.',
                'confirmPassword.same'       => 'Mật khẩu xác nhận không khớp.',
            ], $pdo);

            if ($validator->fails()) {
                Validator::flashInput($_POST, ['password', 'confirmPassword']);
                form_set_errors($validator->errorsFlat());
                require __DIR__ . '/../views/dang-ky-web.php';
                return;
            }

            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $role = 0;

            $result = $this->userModel->data_dang_ky_khach_hang(
                $name,
                $email,
                $password,
                $phone,
                $role
            );

            if ($result) {
                Validator::clearFlash();
                form_flash_success('Đăng ký tài khoản thành công.');
                header("Location: index.php?controller=login&action=index");
                exit;
            }

            Validator::flashInput($_POST, ['password', 'confirmPassword']);
            form_set_errors(['email' => 'Email này đã được đăng ký.']);
            require __DIR__ . '/../views/dang-ky-web.php';
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

        $user = $this->userModel->modelDataUser($idUser);
        $lich_su_don = $this->modelShoping->data_shopping($idUser);
        $errors = form_get_errors();
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

        require __DIR__ . '/../views/lichSUdon.php';
    }

    public function controllerUpateUser()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?controller=login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $idUser = $_SESSION['user']['id'];
            $pdo = $this->pdo();

            $validator = Validator::make($_POST, [
                'name'  => 'required|min:2|max:100',
                'email' => 'required|email|max:255|unique:users,email,id,' . (int) $idUser,
                'phone' => 'required|phone',
            ], [
                'name.required'  => 'Họ tên không được để trống.',
                'email.required' => 'Email không được để trống.',
                'email.email'    => 'Email không đúng định dạng.',
                'email.unique'   => 'Email này đã được sử dụng.',
                'phone.phone'    => 'Số điện thoại không hợp lệ.',
            ], $pdo);

            if ($validator->fails()) {
                Validator::flashInput($_POST);
                Validator::flashErrors($validator->errorsFlat());
                header("Location: index.php?controller=login&action=controllerGETuser");
                exit;
            }

            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');

            $this->userModel->updateUser($name, $email, $phone, $idUser);
            form_flash_success('Cập nhật thông tin thành công.');
            header("Location: index.php?controller=login&action=controllerGETuser");
            exit();
        }
    }

    public function updateMKuser()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?controller=login");
            exit;
        }

        $idUser = $_SESSION['user']['id'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $validator = Validator::make($_POST, [
                'currentPassword' => 'required|max:255',
                'newPassword'     => 'required|min:6|max:255|different:currentPassword',
                'ConfirmPassword' => 'required|same:newPassword',
            ], [
                'currentPassword.required' => 'Vui lòng nhập mật khẩu hiện tại.',
                'newPassword.required'     => 'Vui lòng nhập mật khẩu mới.',
                'newPassword.min'          => 'Mật khẩu phải có ít nhất 6 ký tự.',
                'newPassword.different'    => 'Mật khẩu mới phải khác mật khẩu hiện tại.',
                'ConfirmPassword.same'     => 'Mật khẩu xác nhận không khớp.',
            ]);

            $errors = $validator->errorsFlat();

            if (!$this->userModel->findPassword(trim($_POST['currentPassword'] ?? ''), $idUser)) {
                $errors['currentPassword'] = 'Mật khẩu hiện tại không chính xác.';
            }

            if (!empty($errors)) {
                Validator::flashInput($_POST, ['currentPassword', 'newPassword', 'ConfirmPassword']);
                Validator::flashErrors($errors);
                header("Location: index.php?controller=login&action=viuUpdatemkUser");
                exit;
            }

            $newPassword = trim($_POST['newPassword'] ?? '');
            $result = $this->userModel->updateMK($newPassword, $idUser);

            if ($result) {
                form_flash_success('Đổi mật khẩu thành công.');
                header("Location: index.php?controller=login&action=viuUpdatemkUser");
                exit();
            }

            Validator::flashErrors(['form' => 'Không thể đổi mật khẩu. Vui lòng thử lại.']);
            header("Location: index.php?controller=login&action=viuUpdatemkUser");
            exit();
        }
    }

    public function viuUpdatemkUser()
    {
        $errors = form_get_errors();
        require __DIR__ . '/../views/updateMK.php';
    }
}
