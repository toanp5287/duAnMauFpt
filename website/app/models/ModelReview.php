<?php
class ModelReview
{
    private $conn;
    private $table = 'danh_gia';
    private $tableSP = 'san_pham';
    private $tableUsers = 'users';
    public function __construct()
    {
        $model = new Database();
        $this->conn = $model->getConnection();
    }
    public function modelGetAllReview($id)
    {
        $sql = "SELECT 
    dg.*, 
    sp.ten_san_pham, 
    u.name
FROM danh_gia dg
LEFT JOIN san_pham sp ON dg.san_pham_id = sp.id
LEFT JOIN users u ON dg.user_id = u.id WHERE sp.id = :id AND trang_thai_duyet=1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insertReview($san_pham_id, $user_id, $so_sao, $noi_dung)
    {
        $sql = "INSERT INTO {$this->table}
                (san_pham_id, user_id, so_sao, noi_dung)
                VALUES (:san_pham_id, :user_id, :so_sao, :noi_dung)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':san_pham_id' => $san_pham_id,
            ':user_id' => $user_id,
            ':so_sao' => $so_sao,
            ':noi_dung' => $noi_dung
        ]);
    }
    public function modelChiTietDonHang($orderId)
    {
        $sql = "SELECT 
        orders.id AS order_id,
        orders.user_id,
        orders.ten_khach_hang,
        orders.so_dien_thoai,
        orders.dia_chi,
        orders.cach_thanh_toan,
        orders.tong_tien,
        orders.created_at,
        orders.trang_thai_id,
        orders.maDon,

        order_details.id AS order_detail_id,
        order_details.so_luong,
        order_details.gia,

        san_pham.ten_san_pham,
        san_pham.image,

        trang_thai.trang_thai AS ten_trang_thai

    FROM order_details

    INNER JOIN orders
        ON order_details.order_id = orders.id

    INNER JOIN san_pham
        ON order_details.san_pham_id = san_pham.id

    INNER JOIN trang_thai
        ON orders.trang_thai_id = trang_thai.id

    WHERE order_details.order_id = :order_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':order_id', $orderId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
