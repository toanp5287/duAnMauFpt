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

        private function calculateDiscount(string $saleCode, float $subtotal): float
        {
            $saleCode = trim($saleCode);
            if ($saleCode === '' || $subtotal <= 0) {
                return 0.0;
            }

            $saleData = $this->modelBy->modelSale($saleCode);
            if (!$saleData) {
                return 0.0;
            }

            $gia_tri = (float) $saleData['gia_tri'];
            $loai_giam = $saleData['loai_giam'];
            $discount = ($loai_giam === 'percent')
                ? ($subtotal * $gia_tri) / 100
                : $gia_tri;

            return min($discount, $subtotal);
        }

        private function validateQuantityInput($rawQty, int $fallbackQty, int $stock, string $productName): array
        {
            if ($rawQty === null || $rawQty === '') {
                $qty = $fallbackQty;
            } elseif (!is_numeric($rawQty) || (string) (int) $rawQty !== trim((string) $rawQty)) {
                return [0, 'Số lượng phải là số nguyên.'];
            } else {
                $qty = (int) $rawQty;
            }

            if ($qty <= 0) {
                return [0, 'Số lượng phải lớn hơn 0.'];
            }

            if ($stock < 1) {
                return [0, 'Không thể đặt hàng vì sản phẩm ' . $productName . ' đã hết hàng.'];
            }

            if ($qty > $stock) {
                return [0, 'Số lượng sản phẩm ' . $productName . ' vượt quá tồn kho.'];
            }

            return [$qty, ''];
        }

        /**
         * @param array<int, array<string, mixed>> $items
         * @return array{0: array<int, array<string, mixed>>, 1: array<string, string>}
         */
        private function rebuildCartFromDatabase(array $items): array
        {
            $validated = [];
            $errors = [];

            if (count($items) === 0) {
                return [[], ['cart' => 'Giỏ hàng của bạn đang trống']];
            }

            foreach ($items as $item) {
                $p_id = (int) ($item['san_pham_id'] ?? $item['id'] ?? 0);
                if ($p_id <= 0) {
                    $errors['cart'] = 'Sản phẩm không tồn tại.';
                    break;
                }

                $sp = $this->modelBy->find($p_id);
                if (!$sp) {
                    $errors['cart'] = 'Sản phẩm không tồn tại.';
                    break;
                }

                $productName = (string) ($sp['ten_san_pham'] ?? '');
                [$qty, $qtyError] = $this->validateQuantityInput(
                    $item['so_luong'] ?? null,
                    max(1, (int) ($item['so_luong'] ?? 1)),
                    (int) ($sp['so_luong'] ?? 0),
                    $productName
                );

                if ($qtyError !== '') {
                    $errors['cart'] = $qtyError;
                    break;
                }

                $validated[] = [
                    'id' => $p_id,
                    'san_pham_id' => $p_id,
                    'ten_san_pham' => $sp['ten_san_pham'],
                    'hinh_anh' => $sp['hinh_anh'],
                    'gia' => (float) $sp['gia'],
                    'so_luong' => $qty,
                ];
            }

            return [$validated, $errors];
        }

        /**
         * @return array{0: array<int, array<string, mixed>>, 1: array<string, string>}
         */
        private function buildCartFromPost(int $user_id): array
        {
            $errors = [];
            $list_buy = [];
            $ids = $_POST['cart_selected'] ?? [];
            $qtyInput = $_POST['qty'] ?? [];

            if (!is_array($ids) || count($ids) === 0) {
                return [[], ['cart' => 'Giỏ hàng của bạn đang trống']];
            }

            $gio_hang = $this->modelShoping->modelGioHang($user_id);
            $cartMap = [];
            foreach ($gio_hang as $row) {
                $cartMap[(int) $row['san_pham_id']] = $row;
            }

            foreach ($ids as $rawId) {
                $pid = (int) $rawId;
                if ($pid <= 0) {
                    $errors['cart'] = 'Sản phẩm không tồn tại.';
                    break;
                }

                if (!isset($cartMap[$pid])) {
                    $errors['cart'] = 'Không tìm thấy sản phẩm trong giỏ hàng.';
                    break;
                }

                $sp = $this->modelBy->find($pid);
                if (!$sp) {
                    $errors['cart'] = 'Sản phẩm không tồn tại.';
                    break;
                }

                $productName = (string) ($sp['ten_san_pham'] ?? '');
                $rawQty = array_key_exists($pid, $qtyInput) ? $qtyInput[$pid] : $cartMap[$pid]['so_luong'];
                [$qty, $qtyError] = $this->validateQuantityInput(
                    $rawQty,
                    (int) $cartMap[$pid]['so_luong'],
                    (int) ($sp['so_luong'] ?? 0),
                    $productName
                );

                if ($qtyError !== '') {
                    $errors['cart'] = $qtyError;
                    break;
                }

                $list_buy[] = [
                    'id' => $pid,
                    'san_pham_id' => $pid,
                    'ten_san_pham' => $sp['ten_san_pham'],
                    'hinh_anh' => $sp['hinh_anh'],
                    'gia' => (float) $sp['gia'],
                    'so_luong' => $qty,
                ];
            }

            if (!empty($errors)) {
                return [[], $errors];
            }

            return [$list_buy, []];
        }

        private function renderCheckout(array $list_buy, array $errors = []): void
        {
            if (!empty($errors)) {
                form_set_errors($errors);
            }
            $errors = form_get_errors();
            require __DIR__ . '/../views/checkout.php';
        }

        public function index()
        {
            if (!isset($_SESSION['user'])) {
                header("Location:index.php?controller=login");
                exit();
            }

            $user_id = (int) $_SESSION['user']['id'];
            $list_buy = [];
            $errors = [];

            if (!empty($_POST['cart_selected'])) {
                [$list_buy, $errors] = $this->buildCartFromPost($user_id);

                if (!empty($errors)) {
                    Validator::flashInput($_POST);
                    Validator::flashErrors($errors);
                    header("Location:index.php?controller=shopping_cart&action=index");
                    exit();
                }

                $_SESSION['cart_qty'] = $_POST['qty'] ?? [];
                $_SESSION['cart'] = $list_buy;
            } elseif (!empty($_GET['id'])) {
                $id = (int) $_GET['id'];
                $sp = $this->modelCt->chi_tiet($id);

                if (!$sp) {
                    Validator::flashErrors(['cart' => 'Sản phẩm không tồn tại.']);
                    header("Location:index.php?controller=san_pham&action=index");
                    exit();
                }

                if ((int) ($sp['so_luong'] ?? 0) < 1) {
                    Validator::flashErrors(['cart' => 'Sản phẩm đã hết hàng.']);
                    header("Location:index.php?controller=chi_tiet&action=index&id=" . $id);
                    exit();
                }

                $list_buy[] = [
                    'id' => $id,
                    'san_pham_id' => $id,
                    'ten_san_pham' => $sp['ten_san_pham'],
                    'hinh_anh' => $sp['hinh_anh'],
                    'gia' => (float) $sp['gia'],
                    'so_luong' => 1,
                ];

                $_SESSION['cart'] = $list_buy;
            } else {
                $sessionCart = $_SESSION['cart'] ?? [];
                if (!empty($sessionCart)) {
                    [$list_buy, $errors] = $this->rebuildCartFromDatabase($sessionCart);
                    if (!empty($errors)) {
                        Validator::flashErrors($errors);
                        header("Location:index.php?controller=shopping_cart&action=index");
                        exit();
                    }
                    $_SESSION['cart'] = $list_buy;
                }
            }

            if (empty($list_buy)) {
                Validator::flashErrors(['cart' => 'Giỏ hàng của bạn đang trống']);
                header("Location:index.php?controller=shopping_cart&action=index");
                exit();
            }

            $this->renderCheckout($list_buy);
        }

        public function by()
        {
            if (!isset($_SESSION['user'])) {
                die("Vui lòng đăng nhập");
            }

            $user_id = (int) $_SESSION['user']['id'];

            $validator = Validator::make($_POST, [
                'fullName' => 'required|min:2|max:100',
                'phone'    => 'required|phone',
                'address'  => 'required|min:10|max:500',
                'payment'  => 'required|in:COD,VNPAY',
                'note'     => 'nullable|max:1000',
                'sale'     => 'nullable|max:50',
            ], [
                'fullName.required' => 'Họ tên người nhận không được để trống.',
                'fullName.min'      => 'Họ tên người nhận không hợp lệ.',
                'phone.required'    => 'Số điện thoại không được để trống.',
                'phone.phone'       => 'Số điện thoại không hợp lệ.',
                'address.required'  => 'Địa chỉ nhận hàng không được để trống.',
                'address.min'       => 'Địa chỉ nhận hàng không hợp lệ.',
                'payment.required'  => 'Phương thức thanh toán không hợp lệ.',
                'payment.in'        => 'Phương thức thanh toán không hợp lệ.',
            ]);

            // Bảo mật giá: bỏ qua mọi giá trị tổng tiền/giảm giá client gửi lên.
            unset($_POST['discount'], $_POST['totalPrice'], $_POST['subtotal'], $_POST['tongTien']);

            $checkout_items = $_SESSION['cart'] ?? [];
            [$checkout_items, $cartErrors] = $this->rebuildCartFromDatabase($checkout_items);

            $errors = array_merge($validator->errorsFlat(), $cartErrors);

            if (empty($checkout_items)) {
                $errors['cart'] = $errors['cart'] ?? 'Giỏ hàng của bạn đang trống';
            }

            if (!empty($errors)) {
                Validator::flashInput($_POST);
                $_SESSION['cart'] = $checkout_items;
                $this->renderCheckout($checkout_items, $errors);
                return;
            }

            $fullName = trim($_POST['fullName'] ?? '');
            $phone    = trim($_POST['phone'] ?? '');
            $address  = trim($_POST['address'] ?? '');
            $payment  = trim($_POST['payment'] ?? '');
            $note     = trim($_POST['note'] ?? '');
            $saleCode = trim($_POST['sale'] ?? '');

            $payment_status = 0;
            $vnp_transaction_no = null;
            $payment_time = null;

            $tongTien = 0;
            foreach ($checkout_items as $item) {
                $tongTien += (float) $item['gia'] * (int) $item['so_luong'];
            }

            $discount = $this->calculateDiscount($saleCode, $tongTien);
            if ($saleCode !== '' && $discount <= 0) {
                Validator::flashInput($_POST);
                $this->renderCheckout($checkout_items, ['sale' => 'Mã giảm giá không hợp lệ!']);
                return;
            }

            $tongTienThucTe = max(0, $tongTien - $discount);

            $result = $this->modelBy->data_client(
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

            $id_order = $this->modelBy->getOrderId();

            foreach ($checkout_items as $item) {

                $p_id = $item['san_pham_id'] ?? $item['id'];

                // Tạo chi tiết đơn hàng
                $this->modelBy->order_details(
                    $id_order,
                    $p_id,
                    (int) $item['so_luong'],
                    (float) $item['gia']
                );

                // COD: đặt hàng xong thì trừ kho ngay
                if ($payment === "COD") {
                    $this->modelBy->updateQuantity(
                        $p_id,
                        (int) $item['so_luong']
                    );
                }
            }


            /*
|--------------------------------------------------------------------------
| VNPAY
|--------------------------------------------------------------------------
| Nếu thanh toán VNPAY thì chưa hiển thị thành công ở đây.
| Phải chuyển người dùng sang VNPAY trước.
*/

            if ($payment === "VNPAY") {

                header(
                    "Location:index.php?controller=payment&action=createPayment&id="
                        . $id_order
                );

                exit();
            }


            /*
|--------------------------------------------------------------------------
| COD
|--------------------------------------------------------------------------
| Tới đây chỉ còn COD.
|--------------------------------------------------------------------------
*/


            // Xóa giỏ hàng
            if (empty($_POST['mua_le_id'])) {

                $giohang = $this->modelShoping->findGioHangByUser($user_id);

                if ($giohang) {

                    $this->modelShoping->clearCart(
                        $giohang['id']
                    );
                }
            }


            // Xóa session checkout
            unset($_SESSION['checkout_data']);
            unset($_SESSION['cart_selected']);
            unset($_SESSION['cart_qty']);
            unset($_SESSION['cart']);


            // Lấy thông tin đơn hàng
            $dataClident = $this->modelBy->dataClient($id_order);

            $maDon = $dataClident[0]['maDon'] ?? $id_order;


            // Gửi email
            $mailService = new MailService();

            $customerEmail = $_SESSION['user']['email'];

            $htmlEmail = "
<h2>Đặt hàng thành công</h2>

<p>
    Xin chào <b>{$fullName}</b>,
</p>

<p>
    Cảm ơn bạn đã mua hàng tại Shop.
</p>

<p>
    <b>Mã đơn hàng:</b> {$maDon}
</p>

<p>
    <b>Phương thức thanh toán:</b>
    Thanh toán khi nhận hàng (COD)
</p>

<h3>Danh sách sản phẩm</h3>

<table
    border='1'
    cellpadding='8'
    cellspacing='0'
    width='100%'>

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

        <td>
            " . number_format(
                    $row['gia'],
                    0,
                    ',',
                    '.'
                ) . " VNĐ
        </td>
    </tr>
    ";
            }


            $htmlEmail .= "
</table>

<br>

<p>
    <b>Tổng tiền:</b>
    " . number_format(
                $tongTienThucTe,
                0,
                ',',
                '.'
            ) . " VNĐ
</p>

<p>
    Bạn sẽ thanh toán khi nhận được hàng.
</p>

<p>
    Chúng tôi sẽ xử lý đơn hàng và giao đến bạn sớm nhất.
</p>

<p>
    Xin cảm ơn quý khách đã mua sắm tại
    <b>Shop Điện Thoại</b>.
</p>
";


            $mailService->sendOrderMail(
                $customerEmail,
                'Xác nhận đơn hàng',
                $htmlEmail
            );


            /*
|--------------------------------------------------------------------------
| Màn hình đặt hàng thành công - COD
|--------------------------------------------------------------------------
*/

            $payment = 'COD';
            $order_id = $maDon;

            require __DIR__ . '/../views/order-success.php';

            exit();
        }

        public function sale()
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                header('Content-Type: application/json');

                if (!isset($_SESSION['user'])) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Vui lòng đăng nhập.',
                        'discount' => 0,
                    ]);
                    return;
                }

                $sale = trim($_POST['sale'] ?? '');
                $checkout_items = $_SESSION['cart'] ?? [];
                [$checkout_items] = $this->rebuildCartFromDatabase($checkout_items);

                $tongToanBo = 0;
                foreach ($checkout_items as $item) {
                    $tongToanBo += (float) $item['gia'] * (int) $item['so_luong'];
                }

                if ($sale === '') {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Vui lòng nhập mã giảm giá.',
                        'discount' => 0,
                    ]);
                    return;
                }

                $saleData = $this->modelBy->modelSale($sale);

                if (!$saleData) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Mã giảm giá không hợp lệ!',
                        'discount' => 0,
                    ]);
                    return;
                }

                $discount = $this->calculateDiscount($sale, $tongToanBo);

                echo json_encode([
                    'status' => 'success',
                    'message' => 'Áp dụng mã thành công!',
                    'discount' => $discount,
                ]);
                exit;
            }
        }
    }
