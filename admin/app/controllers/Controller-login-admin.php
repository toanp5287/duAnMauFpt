<?php

class Auth
{
    private $modelAUTH;

    public function __construct()
    {
        $this->modelAUTH = new Data_auth();
    }

    public function index()
    {
        $errors = form_get_errors();
        require __DIR__ . '/../views/login-admin.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
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
                require __DIR__ . '/../views/login-admin.php';
                return;
            }

            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            $user = $this->modelAUTH->data_login($email, $password);

            if ($user) {
                $_SESSION['admin'] = $user;
                $_SESSION['msg'] = "Đăng nhập thành công";
                $_SESSION['type'] = "info";
                header("Location: index.php?controller=san_pham&action=index");
                exit();
            }

            Validator::flashInput($_POST, ['password']);
            form_set_errors(['auth' => 'Sai tài khoản hoặc mật khẩu']);
            require __DIR__ . '/../views/login-admin.php';
        } else {
            require __DIR__ . '/../views/login-admin.php';
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: index.php?controller=auth&action=index");
        exit();
    }
}

function checkLogin()
{
    if (
        !isset($_SESSION['admin']) ||
        $_SESSION['admin']['role'] != 1
    ) {
        header("Location: index.php?controller=auth&action=index");
        exit();
    }
}
