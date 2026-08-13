<?php

class Model_by
{
    private $conn;
    private $table = 'orders';
    private $tableDHCT = 'order_details';
    private $tableSP = 'san_pham';
    private $tableSale = 'coupons';
    private $tableOrderAndCoupon = 'order_coupon';
    private $tableCoupons = 'coupons';
    public function __construct()
    {
        $model = new Database();
        $this->conn = $model->getConnection();
    }

    public function generateOrderCode()
    { //tao ma don hang
        do {

            $order_code = 'DH-' . date('Ymd') . rand(1000, 9999);

            $sql = "SELECT COUNT(*) FROM orders WHERE maDon = :order_code";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':order_code' => $order_code
            ]);
        } while ($stmt->fetchColumn() > 0);

        return $order_code;
    }

    /*
    |--------------------------------------------------------------------------
    | TẠO ĐƠN HÀNG
    |--------------------------------------------------------------------------
    */

    public function data_client(
        $customer_name,
        $phone,
        $diaChi,
        $payment_method,
        $ghiChu,
        $tongTien,
        $user_id,
        $trang_thai_id,
        $payment_status,
        $vnp_transaction_no,
        $payment_time
    ) {
        $maDon  = $this->generateOrderCode();

        $sql = "INSERT INTO " . $this->table . "(
    user_id,
    ten_khach_hang,
    so_dien_thoai,
    dia_chi,
    cach_thanh_toan,
    ghi_chu,
    tong_tien,
    maDon,
    trang_thai_id,
    payment_status,
    vnp_transaction_no,
        payment_time
)
VALUES(
   :user_id,
        :customer_name,
        :phone,
        :diaChi,
        :payment_method,
        :ghiChu,
        :tongTien,
        :maDon,
        :trang_thai_id,
        :payment_status,
        :vnp_transaction_no,
        :payment_time
)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':maDon', $maDon);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':customer_name', $customer_name, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':diaChi', $diaChi, PDO::PARAM_STR);
        $stmt->bindParam(
            ':payment_method',
            $payment_method,
            PDO::PARAM_STR
        );
        $stmt->bindParam(':ghiChu', $ghiChu, PDO::PARAM_STR);
        $stmt->bindParam(':tongTien', $tongTien);
        $stmt->bindParam(':trang_thai_id', $trang_thai_id);

        $stmt->bindParam(':payment_status', $payment_status, PDO::PARAM_INT);
        $stmt->bindParam(':vnp_transaction_no', $vnp_transaction_no, PDO::PARAM_STR);
        $stmt->bindParam(':payment_time', $payment_time);

        return $stmt->execute();
    }

    /*
    |--------------------------------------------------------------------------
    | LẤY ID ORDER VỪA TẠO
    |--------------------------------------------------------------------------
    */

    public function getOrderId()
    {
        return $this->conn->lastInsertId();
    }

    /*
    |--------------------------------------------------------------------------
    | THÊM CHI TIẾT ĐƠN HÀNG
    |--------------------------------------------------------------------------
    */

    public function order_details(
        $order_id,
        $san_pham_id,
        $so_luong,
        $gia,

    ) {
        $sql = "INSERT INTO " . $this->tableDHCT . " (
    order_id,
    san_pham_id,
    so_luong,
    gia
) VALUES (
    :order_id,
    :san_pham_id,
    :so_luong,
    :gia
)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
        $stmt->bindParam(':san_pham_id', $san_pham_id, PDO::PARAM_INT);
        $stmt->bindParam(':so_luong', $so_luong, PDO::PARAM_INT);
        $stmt->bindParam(':gia', $gia);


        return $stmt->execute();
    }

    /*
    |--------------------------------------------------------------------------
    | LẤY 1 SẢN PHẨM
    |--------------------------------------------------------------------------
    */

    public function find($san_pham_id)
    {
        $sql = "SELECT * FROM " . $this->tableSP .
            " WHERE id = :san_pham_id LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':san_pham_id' => $san_pham_id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /*
    |--------------------------------------------------------------------------
    | TRỪ SỐ LƯỢNG KHO
    |--------------------------------------------------------------------------
    */

    public function updateQuantity(
        $san_pham_id,
        $so_luong_mua
    ) {


        $sql = "UPDATE " . $this->tableSP .
            " SET so_luong = so_luong - :so_luong_mua
        WHERE id = :san_pham_id
        AND so_luong >= :so_luong_mua";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':so_luong_mua', $so_luong_mua, PDO::PARAM_INT);
        $stmt->bindParam(':san_pham_id', $san_pham_id, PDO::PARAM_INT);

        return $stmt->execute();
    }
    public function modeGetAllSale()
    {
        $sql = "SELECT * FROM " . $this->tableSale;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function modelSale($sale)
    {
        // Sử dụng UPPER() trong SQL để ép cả mã trong DB và mã người dùng nhập về chữ IN HOA
        // Như vậy gõ "giam20k", "Giam20k" hay "GIAM20K" đều khớp chính xác 100%
        $sql = "SELECT * FROM " . $this->tableCoupons . " WHERE ma_giam_gia = :sale";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':sale', $sale, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return false;
        }


        return $result;
    }
    public function getByIds($ids)
    {
        if (empty($ids)) {
            return [];
        }

        $placeholders = implode(',', array_fill(0, count($ids), '?'));

        $sql = "SELECT 
                sp.id,
                sp.ten_san_pham,
                sp.gia,
                sp.hinh_anh
            FROM san_pham sp
            WHERE sp.id IN ($placeholders)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($ids);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function dataClient($id)
    {
        $sql = "SELECT orders.*,  order_details.gia, order_details.so_luong, san_pham.ten_san_pham FROM orders JOIN order_details ON orders.ID = order_details.order_id JOIN san_pham ON order_details.san_pham_id =  san_pham.id WHERE orders.id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getOrderById($id)
    {

        $sql = "SELECT * FROM orders WHERE id=:id";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function paymentSuccess($maDon, $transaction)
    {

        $sql = "UPDATE orders
          SET
          payment_status=1,
          vnp_transaction_no=:transaction,
          payment_time=NOW()
          WHERE maDon=:maDon";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([

            ':transaction' => $transaction,

            ':maDon' => $maDon

        ]);
    }
    public function updatePayment(
        $maDon,
        $payment_status,
        $transactionNo = null,
        $paymentTime = null
    ) {

        // Thanh toán thành công
        if ($payment_status == 1) {

            $sql = "UPDATE orders
                SET payment_status = :payment_status,
                    vnp_transaction_no = :transactionNo,
                    payment_time = :paymentTime
                WHERE maDon = :maDon";

            // Khách hủy thanh toán
        } elseif ($payment_status == 2) {

            $sql = "UPDATE orders
                SET trang_thai_id = 8,
                    payment_status = :payment_status,
                    vnp_transaction_no = :transactionNo,
                    payment_time = :paymentTime
                WHERE maDon = :maDon";

            // Thanh toán thất bại
        } elseif ($payment_status == 3) {

            $sql = "UPDATE orders
                SET trang_thai_id = 1,
                    payment_status = :payment_status,
                    vnp_transaction_no = :transactionNo,
                    payment_time = :paymentTime
                WHERE maDon = :maDon";

            // Chưa thanh toán
        } else {

            $sql = "UPDATE orders
                SET payment_status = :payment_status
                WHERE maDon = :maDon";
        }

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':payment_status' => $payment_status,
            ':transactionNo'  => $transactionNo,
            ':paymentTime'    => $paymentTime,
            ':maDon'          => $maDon
        ]);
    }
}
