<?php

// Khởi tạo session để lưu trữ thông tin người dùng (ví dụ: giỏ hàng, thông tin đăng nhập) xuyên suốt các trang

// Lấy tên controller từ tham số URL 'controller'. Nếu không có, mặc định là 'san_pham' (trang chủ/sản phẩm)
$nameController = $_GET['controller'] ?? 'san_pham';

// Lấy tên hành động (action) từ tham số URL 'action'. Nếu không có, mặc định là 'index' (trang chính của controller)
$action = $_GET['action'] ?? 'index';

// Khởi tạo biến $controller dựa trên giá trị của $nameController
switch ($nameController) {
    case "san_pham":
        // Nếu là 'san_pham', nhúng file controller tương ứng và khởi tạo đối tượng
        $controller = new San_pham;

        break;
    case "category":
        // Nếu là 'category' (danh mục), nhúng controller xử lý danh mục

        $controller = new Category;
        break;
    case 'chi_tiet':
        // Nếu là 'chi_tiet' (chi tiết sản phẩm), nhúng controller xử lý chi tiết sản phẩm

        $controller = new Chitiet;
        break;
    case 'buy':
        // Nếu là 'buy' (mua hàng/thanh toán), nhúng controller xử lý đơn hàng

        $controller = new Buy;
        break;
    case 'shopping_cart':
        // Nếu là 'shopping_cart' (giỏ hàng), nhúng controller xử lý giỏ hàng

        $controller = new Shopping_cart;
        break;
    case 'login':
        // Nếu là 'login' (đăng nhập/đăng ký/đăng xuất), nhúng controller xử lý xác thực

        $controller = new Login;
        break;
    case 'payment':
        // Nếu là 'login' (đăng nhập/đăng ký/đăng xuất), nhúng controller xử lý xác thực

        $controller = new Payment;
        break;
    default:
        // Nếu không khớp controller nào, dừng chương trình và báo lỗi
        die('controller khong ton tai');
}

// Kiểm tra xem phương thức (action) được gọi có tồn tại trong class controller hay không
if (method_exists($controller, $action)) {
    // Nếu tồn tại, thực thi phương thức đó
    $controller->$action();
} else {
    // Nếu không tồn tại, dừng chương trình và báo lỗi
    die('loi -> action khong ton tai');
}
