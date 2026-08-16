<?php
class Model_order_detel
{
    private $conn;
    private $table = 'order_details';
    private $tableTrangThai = 'trang_thai';

    public function __construct()
    {
        $model = new Database();
        $this->conn = $model->getConnection();
    }
    public function data_order_detel($id)
    {
        $sql = "
       SELECT 
    order_details.id AS idCT,
    order_details.order_id,
    order_details.san_pham_id,
    order_details.so_luong AS sl,
    order_details.gia,  
    san_pham.ten_san_pham,
    orders.id AS idDon,
    orders.user_id,
    orders.ten_khach_hang,
    orders.trang_thai_id,
    orders.payment_status,
    trang_thai.trang_thai AS nameTrangThai
FROM order_details
LEFT JOIN san_pham 
    ON order_details.san_pham_id = san_pham.id
LEFT JOIN orders  
    ON order_details.order_id = orders.id 
LEFT JOIN trang_thai  
    ON orders.trang_thai_id = trang_thai.id 
WHERE order_details.order_id = :id;
    ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function dataTrangThai()
    {
        $sql = "SELECT trang_thai.*, trang_thai.id AS idTrangThai FROM " . $this->tableTrangThai;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function model_delete($id)
    {

        $sql = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id' => $id
        ]);
    }
    public function model_search($keyword)
    {
        $sql = "SELECT 
            order_details.*,
            san_pham.ten_san_pham,
            orders.ten_khach_hang,
            orders.trang_thai,
            orders.id AS order_id,
            users.id AS user_id

        FROM " . $this->table .

            " JOIN san_pham 
            ON order_details.san_pham_id = san_pham.id

        JOIN orders 
            ON order_details.order_id = orders.id

        JOIN users
            ON orders.user_id = users.id

        WHERE 1";;
        $keyword = "%$keyword%";
        if ($keyword != '') {



            $sql .= " AND (
                    orders.ten_khach_hang LIKE :keyword'
                    OR san_pham.ten_san_pham LIKE :keyword'
                  )";
        }



        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':keyword' => $keyword
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function modelDuyetDon($idTrangThai, $orderId)
    {
        $sql = "SELECT trang_thai_id
            FROM orders
            WHERE id = :orderId";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':orderId' => $orderId
        ]);

        $current = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$current) {
            return false;
        }

        $currentStatus = (int)$current['trang_thai_id'];
        $nextStatus    = (int)$idTrangThai;

        // Quy định chuyển trạng thái
        $allowedTransitions = [

            // Chờ xác nhận
            1 => [2, 7],

            // Đã xác nhận
            2 => [3, 7],

            // Đang chuẩn bị hàng
            3 => [4, 7],

            // Đang giao hàng
            4 => [5],

            // Giao hàng thành công
            5 => [6],

            // Đã nhận hàng
            6 => [9],

            // Yêu cầu hoàn hàng
            9 => [10],

            // Shop xác nhận yêu cầu hoàn hàng
            10 => [11],
        ];

        // Kiểm tra chuyển trạng thái hợp lệ
        if (
            !isset($allowedTransitions[$currentStatus]) ||
            !in_array($nextStatus, $allowedTransitions[$currentStatus])
        ) {
            return false;
        }

        // Cập nhật trạng thái
        $sql = "UPDATE orders
            SET trang_thai_id = :idTrangThai
            WHERE id = :orderId";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':idTrangThai' => $nextStatus,
            ':orderId'     => $orderId
        ]);
    }
    public function modelThongKe()
    {
        $sql = "SELECT 
                SUM(order_details.so_luong) AS soSP,

                COUNT(DISTINCT orders.user_id) AS SOKH,

                COUNT(DISTINCT orders.id) AS sodonhang,

                SUM(order_details.gia * order_details.so_luong) AS doanhThu,

                COUNT(
                    DISTINCT CASE 
                        WHEN orders.trang_thai_id = 5 
                        THEN orders.id 
                    END
                ) AS donHoanThanh,

                COUNT(
                    DISTINCT CASE 
                        WHEN orders.trang_thai_id = 6 
                        THEN orders.id 
                    END
                ) AS donHuy

            FROM order_details

            JOIN orders 
                ON order_details.order_id = orders.id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function donchaynhat()
    {
        $sql = "SELECT 
                san_pham.ten_san_pham,
                SUM(order_details.so_luong) AS tong_da_ban

            FROM order_details

            JOIN san_pham 
                ON order_details.san_pham_id = san_pham.id

            GROUP BY 
                san_pham.id,
                san_pham.ten_san_pham

            ORDER BY tong_da_ban DESC

            LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function insertMessage($order_id, $user_id, $message, $is_read)
    {
        $sql = "INSERT INTO `order_messages`(`order_id`, `sender_id`, `message`, `is_read`) 
        VALUES (:order_id,:user_id, :message, :is_read)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':order_id' => $order_id,
            ':user_id' => $user_id,
            ':message' => $message,
            ':is_read' => $is_read,

        ]);
    }
    public function message($id)
    {

        $sql = "SELECT * FROM order_messages WHERE order_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':id' => $id,
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
