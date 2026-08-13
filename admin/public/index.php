<?php
session_start();



require_once __DIR__ . '/../config/Database.php';

require_once __DIR__ . '/../app/models/Model-login-admin.php';

require_once __DIR__ . '/../app/models/data-san-pham.php';
require_once __DIR__ . '/../app/models/data-loai-hang.php';
require_once __DIR__ . '/../app/models/model-khach-hang.php';
require_once __DIR__ . '/../app/models/order_details.php';

require __DIR__ . '/../app/controllers/san-pham.php';
require_once __DIR__ . '/../app/controllers/loai-hang.php';
require_once __DIR__ . '/../app/controllers/Controller-login-admin.php';

require_once __DIR__ . '/../app/controllers/khach-hang.php';
require_once __DIR__ . '/../app/controllers/orders_detail.php';


require_once __DIR__ . '/../routers/router.php';
































// $nameController = $_GET['controller'] ?? 'loai_hang';

// $action = $_GET['action'] ?? 'index';

// $protected = [
//     'san_pham',
//     'loai_hang',
//     'khach_hang',
//     'order_detail',
//     'user'
// ];

// // chỉ check login với controller cần bảo vệ
// if (in_array($nameController, $protected)) {

//     if (
//         !isset($_SESSION['admin']) ||
//         $_SESSION['admin']['role'] != 1
//     ) {

//         header("Location: index.php?controller=auth&action=index");

//         exit();
//     }
// }

// switch ($nameController) {

//     case 'auth':

//         require __DIR__ . '/../Auth/Controllers/Controller-login-admin.php';

//         $controller = new Auth;
//         break;

//     case 'san_pham':

//         require __DIR__ . '/../admin/controllers/san-pham.php';

//         $controller = new San_pham;

//         break;

//     case 'loai_hang':

//         require __DIR__ . '/../admin/controllers/loai-hang.php';

//         $controller = new Loai_hang;

//         break;

//     case 'khach_hang':

//         require __DIR__ . '/../admin/controllers/khach-hang.php';

//         $controller = new Khach_hang;

//         break;

//     case 'order_detail':

//         require __DIR__ . '/../admin/controllers/orders_detail.php';

//         $controller = new Order_detail;

//         break;
//     case 'user':
//         require __DIR__ . '/../admin/controllers/Users.php';
//         $controller = new ControllerUsers;
//         break;
//     default:

//         die('controller không hợp lệ');
// }

// if (method_exists($controller, $action)) {

//     $controller->$action();
// } else {

//     die('action không tồn tại');
// }
