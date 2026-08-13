<?php

$nameController = $_GET['controller'] ?? 'loai_hang';

$action = $_GET['action'] ?? 'index';

$protected = [
    'san_pham',
    'loai_hang',
    'khach_hang',
    'order_detail',
    'user',

];

// chỉ check login với controller cần bảo vệ
if (in_array($nameController, $protected)) {

    if (
        !isset($_SESSION['admin']) ||
        $_SESSION['admin']['role'] != 1
    ) {

        header("Location: index.php?controller=auth&action=index");
        exit();
    }
}

switch ($nameController) {
    case '/':
    case 'auth':
        $controller = new Auth;

        break;

    case 'san_pham':



        $controller = new San_pham;

        break;

    case 'loai_hang':


        $controller = new Loai_hang;

        break;

    case 'khach_hang':


        $controller = new Khach_hang;

        break;

    case 'order_detail':


        $controller = new Order_detail;

        break;
    case 'user':
        $controller = new ControllerUsers;
        break;
    default:

        die('controller không hợp lệ');
}

if (method_exists($controller, $action)) {

    $controller->$action();
} else {

    die('action không tồn tại');
}
