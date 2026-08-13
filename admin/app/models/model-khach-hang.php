<?php



class Model_khach_hang
{
    private $conn;
    private $table = "orders";

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }


    // private $conn;
    // public function __construct()
    // {
    //     $this->conn = mysqli_connect("localhost", "root", "", "ban_hang");
    // }
    public function data_khach_hang($id)
    {
        if (empty($id)) {
            $sql = "SELECT 
                    orders.*, 
                    orders.id AS donHangId,
                    orders.trang_thai_id,
                    orders.payment_status,
                    users.name AS name
                FROM " . $this->table . " 
                JOIN users ON orders.user_id = users.id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT 
                    orders.*, 
                    orders.id AS donHangId,
                    orders.trang_thai_id,
                   orders.payment_status,
                    users.name AS name
                FROM " . $this->table . " 
                JOIN users ON orders.user_id = users.id 
                WHERE orders.id = :id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
    // public function model_delete($id)
    // {
    //     $id = (int)$id;
    //     $sql = "DELETE FROM orders WHERE id=$id";
    //     mysqli_query($this->conn, $sql);
    // }
    // public function model_update($id, $user_id, $trang_thai, $ten_khach_hang, $so_dien_thoai, $dia_chi, $cach_thanh_toan, $ghi_chu, $tong_tien, $created_at)
    // {
    //     $id = (int)$id;
    //     $user_id = (int)$user_id;
    //     $trang_thai = mysqli_real_escape_string($this->conn, $trang_thai);
    //     $ten_khach_hang = mysqli_real_escape_string($this->conn, $ten_khach_hang);
    //     $so_dien_thoai = $so_dien_thoai;
    //     $dia_chi = mysqli_real_escape_string($this->conn, $dia_chi);
    //     $cach_thanh_toan = mysqli_real_escape_string($this->conn, $cach_thanh_toan);
    //     $ghi_chu = mysqli_real_escape_string($this->conn, $ghi_chu);
    //     $tong_tien = (int)$tong_tien;
    //     $sql = "UPDATE orders SET user_id=$user_id, trang_thai='$trang_thai', 
    //     ten_khach_hang='$ten_khach_hang', so_dien_thoai=$so_dien_thoai,
    //      dia_chi='$dia_chi', cach_thanh_toan='$cach_thanh_toan', ghi_chu='$ghi_chu', tong_tien=$tong_tien, created_at='$created_at' WHERE id=$id";
    //     $result = mysqli_query($this->conn, $sql);
    //     if (!$result) {
    //         die(mysqli_error($this->conn));
    //     }
    // }
    public function find_khach_hang($id)
    {
        $sql = "SELECT
                orders.id AS order_id,
                users.id AS user_id,
                orders.*,
                users.name,
                users.role
            FROM orders
            LEFT JOIN users
                ON orders.user_id = users.id
            WHERE orders.id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
