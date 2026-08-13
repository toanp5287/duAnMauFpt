    <?php


    class Buy
    {
        private $modelBy;
        private $modelCt;
        private $modelShoping;
        public function __construct()
        {
            $this->modelBy = new Model_by();
            $this->modelCt = new Model_chi_tiet();
            $this->modelShoping = new Model_shopping();
        }
        public function index()
        {
            if (!isset($_SESSION['user'])) {
                header("Location:index.php?controller=login");
                exit();
            }

            $list_buy = [];

            // ====== MUA TỪ GIỎ HÀNG ======
            if (!empty($_POST['cart_selected'])) {

                $_SESSION['cart_qty'] = $_POST['qty'] ?? [];

                $ids = $_POST['cart_selected'];
                $qty = $_SESSION['cart_qty'];

                $data = $this->modelBy->getByIds($ids);

                foreach ($data as $sp) {

                    $id = $sp['id'];

                    $list_buy[] = [
                        'id' => $id,
                        'san_pham_id' => $id,   // 🔥 quan trọng
                        'ten_san_pham' => $sp['ten_san_pham'],
                        'hinh_anh' => $sp['hinh_anh'],
                        'gia' => $sp['gia'],
                        'so_luong' => $qty[$id] ?? 1
                    ];
                }

                $_SESSION['cart'] = $list_buy;
            }

            // ====== MUA NGAY ======
            elseif (!empty($_GET['id'])) {

                $id = (int)$_GET['id'];
                $sp = $this->modelCt->chi_tiet($id);

                $list_buy[] = [
                    'id' => $id,
                    'san_pham_id' => $id,
                    'ten_san_pham' => $sp['ten_san_pham'],
                    'hinh_anh' => $sp['hinh_anh'],
                    'gia' => $sp['gia'],
                    'so_luong' => 1
                ];

                $_SESSION['cart'] = $list_buy;
            }

            if (empty($list_buy)) {
                header("Location:index.php?controller=shopping_cart&action=index");
                exit();
            }

            require __DIR__ . '/../views/checkout.php';
        }
        /*
        |--------------------------------------------------------------------------
        | ĐẶT HÀNG
        |--------------------------------------------------------------------------
        */

        public function by()
        {

            // 1. Kiểm tra đăng nhập
            if (!isset($_SESSION['user'])) {
                die("Vui lòng đăng nhập");
            }

            // 2. Lấy thông tin khách hàng từ Form POST
            $fullName = $_POST['fullName'] ?? '';
            $phone    = $_POST['phone'] ?? '';
            $address  = $_POST['address'] ?? '';
            $payment  = $_POST['payment'] ?? '';
            $note     = $_POST['note'] ?? '';
            $discount = (float)($_POST['discount'] ?? 0); // Số tiền được giảm từ coupon (nếu có)
            $user_id  = $_SESSION['user']['id'];

            $payment_status = 0;          // Mặc định chưa thanh toán
            $vnp_transaction_no = null;   // Chưa có mã giao dịch
            $payment_time = null;         // Chưa thanh toán nên chưa có thời gian

            // 3. Lấy dữ liệu mua hàng đã được thống nhất trong Session ở hàm index()
            $checkout_items =  $_SESSION['cart'] ?? [];

            if (empty($checkout_items)) {
                echo "<script>
                alert('Không tìm thấy thông tin sản phẩm cần thanh toán!');
                window.location.href='index.php?controller=shopping_cart&action=index';
            </script>";
                exit();
            }

            // 4. Tính toán tổng tiền của đơn hàng từ danh sách sản phẩm thống nhất
            $tongTien = 0;
            foreach ($checkout_items as $item) {
                $tongTien += (float)$item['gia'] * (int)$item['so_luong'];
            }

            // Trừ đi số tiền giảm giá (nếu tổng tiền sau giảm nhỏ hơn 0 thì gán bằng 0)
            $tongTienThucTe = $tongTien - $discount;
            if ($tongTienThucTe < 0) {
                $tongTienThucTe = 0;
            }

            // 5. Tạo đơn hàng gốc (Lưu vào bảng orders/hóa đơn)
            $result =   $this->modelBy->data_client(
                $fullName,
                $phone,
                $address,
                $payment,
                $note,
                $tongTienThucTe,
                $user_id,
                1,
                $payment_status,
                $vnp_transaction_no,
                $payment_time
            );

            // Lấy ID hóa đơn vừa được tạo tự động tăng trong DB
            $id_order = $this->modelBy->getOrderId();

            // 6. Chạy vòng lặp lưu Chi tiết đơn hàng & Trừ kho số lượng

            foreach ($checkout_items as $item) {

                $p_id = $item['san_pham_id'] ?? $item['id'];

                // Luôn lưu chi tiết đơn hàng
                $this->modelBy->order_details(
                    $id_order,
                    $p_id,
                    (int)$item['so_luong'],
                    (float)$item['gia']
                );

                // Chỉ trừ kho nếu là COD
                if ($payment == "COD") {

                    $this->modelBy->updateQuantity(
                        $p_id,
                        (int)$item['so_luong']
                    );
                }
            }
            if ($payment == "VNPAY") {
                header("Location:index.php?controller=payment&action=createPayment&id=" . $id_order);
                exit();
            }
            // 7. XỬ LÝ HẬU KỲ: Nếu mua từ GIỎ HÀNG, tiến hành xóa các sản phẩm vừa mua ra khỏi giỏ
            // (Nếu là Mua ngay, $_POST['mua_le_id'] hoặc $_GET['id'] sẽ tồn tại, ta không cần dọn giỏ hàng)
            if (empty($_POST['mua_le_id'])) {
                $giohang = $this->modelShoping->findGioHangByUser($user_id);
                if ($giohang) {
                    // Lấy danh sách các ID sản phẩm vừa mua để xóa đích danh trong DB giỏ hàng chi tiết
                    $bought_ids = array_column($checkout_items, 'id');

                    // Bạn có thể dùng hàm clearCart cũ của bạn nếu nó xóa toàn bộ giỏ,
                    // hoặc tối ưu hơn là chỉ xóa những món vừa được chọn mua bằng cách truyền $bought_ids vào xử lý (tùy thuộc vào model của bạn).
                    if ($payment == "COD") {

                        $this->modelShoping->clearCart($giohang['id']);
                    }
                }
            }

            // 8. Xóa dữ liệu nháp thanh toán trong Session để tránh trùng lặp cho đơn sau
            unset($_SESSION['checkout_data']);
            unset($_SESSION['cart_selected']);
            unset($_SESSION['cart_qty']);
            $mailService = new MailService();


            $customerEmail = $_SESSION['user']['email'];
            // $dataClident =  $this->modelBy->dataClient($id_order);

            // $maDOn = $dataClident['maDon'];


            $dataClident = $this->modelBy->dataClient($id_order);

            $maDon = $dataClident[0]['maDon'];
            // echo "đat hang thanh cong";
            // die();
            $htmlEmail = "
<h2>Đặt hàng thành công</h2>

<p>Xin chào <b>{$fullName}</b>,</p>

<p>Cảm ơn bạn đã mua hàng tại Shop.</p>

<p><b>Mã đơn hàng:</b> {$maDon}</p>

<h3>Danh sách sản phẩm</h3>

<table border='1' cellpadding='8' cellspacing='0' width='100%'>
    <tr>
        <th>Tên sản phẩm</th>
        <th>Số lượng</th>
        <th>Đơn giá</th>
    </tr>
";

            foreach ($dataClident as $row) {
                $htmlEmail .= "
    <tr>
        <td>{$row['ten_san_pham']}</td>
        <td>{$row['so_luong']}</td>
        <td>" . number_format($row['gia'], 0, ',', '.') . " VNĐ</td>
    </tr>
    ";
            }

            $htmlEmail .= "
</table>

<br>

<p><b>Tổng tiền:</b> " . number_format($tongTienThucTe, 0, ',', '.') . " VNĐ</p>

<p>Chúng tôi sẽ xử lý đơn hàng và giao đến bạn sớm nhất.</p>

<p>Xin cảm ơn quý khách đã mua sắm tại <b>Shop Điện Thoại</b>.</p>
";

            $result = $mailService->sendOrderMail(
                $customerEmail,
                'Xác nhận đơn hàng',
                $htmlEmail
            );

            // 9. Thông báo thành công và chuyển hướng
            echo "<script>
            alert('Đặt hàng thành công!');
            window.location.href = 'index.php?controller=san_pham&action=index';
        </script>";
            exit();
        }
        public function sale()
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                header('Content-Type: application/json');

                $sale = trim($_POST['sale'] ?? '');
                $tongToanBo = (float)($_POST['tongToanBo'] ?? 0);

                // LẤY DATA TỪ MODEL
                $saleData = $this->modelBy->modelSale($sale);

                // CHECK MÃ HỢP LỆ
                if (!$saleData) {
                    echo json_encode([
                        "status" => "error",
                        "message" => "Mã giảm giá không hợp lệ!",
                        "discount" => 0
                    ]);
                    return;
                }

                // LẤY DỮ LIỆU ĐÚNG
                $gia_tri = (float)$saleData['gia_tri'];
                $loai_giam = $saleData['loai_giam'];

                $discount = 0;

                // TÍNH GIẢM GIÁ
                if ($loai_giam === 'percent') {
                    $discount = ($tongToanBo * $gia_tri) / 100;
                } else {
                    $discount = $gia_tri;
                }

                // TRÁNH GIẢM QUÁ TIỀN

                if ($discount > $tongToanBo) {
                    $discount = $tongToanBo;
                }

                echo json_encode([
                    "status" => "success",
                    "message" => "Áp dụng mã thành công!",
                    "discount" => $discount
                ]);
                exit;
            }
        }
    }
