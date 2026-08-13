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
        require __DIR__ . '/../Views/login-admin.php';
    }

    public function login()
    {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {



            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->modelAUTH->data_login($email, $password);

            if ($user) {

                // session admin
                $_SESSION['admin'] = $user;

                $_SESSION['msg'] = "Đăng nhập thành công";
                $_SESSION['type'] = "info";

                header("Location: index.php?controller=san_pham&action=index");
                exit();
            } else {

                $error = "Sai tài khoản hoặc mật khẩu";

                require __DIR__ . '/../views/login-admin.php';
            }
        } else {
            require __DIR__ . '/../views/login-admin.php';
        }
    }

    //    public function dang_ky()
    //     {
    //         if ($_SERVER['REQUEST_METHOD'] == "POST") {

    //             $model = new Data_auth;

    //             $email = $_POST['email'] ?? '';
    //             $password = $_POST['mk'] ?? '';

    //             $result = $model->data_dang_ky($email, $password);

    //             if ($result == "email_ton_tai") {

    //                 header("Location: /web-ban-hang/admin/index.php?controller=auth&action=dang_ky&error=email_ton_tai");
    //                 exit();
    //             } elseif ($result) {

    //                 header("Location: /web-ban-hang/admin/index.php?controller=auth&action=index");
    //                 exit();
    //             } else {

    //                 echo "Đăng ký thất bại";
    //             }
    //         }

    //         require __DIR__ . '/../V iews/dang-ky.php';
    //     }

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
