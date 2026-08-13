<?php

use LDAP\Result;

class Model_shopping
{
    private $conn;
    private $tableOrder = 'orders';
    private $tableOrderDel = 'order_details';
    private $tableSP = 'san_pham';
    private $tableGH = 'giohang';
    private $tableGHCT = 'giohang_chi_tiet';
    public function __construct()
    {
        $model = new Database();
        $this->conn = $model->getConnection();
    }

    public function data_shopping($user_id)
    {
        $sql = "SELECT
    orders.id,
    orders.ten_khach_hang,
    orders.so_dien_thoai,
    orders.ten_khach_hang,
    orders.maDon,
    orders.tong_tien,
    orders.created_at,
    orders.trang_thai_id,
    trang_thai.trang_thai AS ten_trang_thai
FROM orders
LEFT JOIN trang_thai
ON orders.trang_thai_id = trang_thai.id
WHERE orders.user_id = :user_id
ORDER BY orders.id DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':user_id' => $user_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function modelGioHang($id)
    {

        $sql = "SELECT
                gh.id AS giohang_id,
                ghct.id,
                ghct.so_luong,
                sp.id AS san_pham_id,
                sp.ten_san_pham,
                sp.gia,
                sp.hinh_anh
            FROM " . $this->tableGH . " gh
            JOIN " . $this->tableGHCT . " ghct
                ON gh.id = ghct.giohang_id
            JOIN " . $this->tableSP . " sp
                ON ghct.san_pham_id = sp.id
            WHERE gh.user_id = :idUser";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(
            [
                ':idUser' => $id
            ]
        );
        if (!$stmt) {
            return [];
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insertGioHang($user_id)
    {

        $sql = "INSERT INTO " . $this->tableGH . "(
                user_id,
                tong_san_pham,
                tong_tien,
                created_at
            )
            VALUES(
                :user_id,
                0,
                0,
                NOW()
            )";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $this->conn->lastInsertId();;
    }
    public function insertGioHangChiTiet($giohang_id, $san_pham_id, $so_luong)
    {
        $sql = "INSERT INTO " . $this->tableGHCT . "(
                giohang_id,
                san_pham_id,
                so_luong
            )
            VALUES(
                :giohang_id,
                :san_pham_id,
                :so_luong
            )";

        $stmt =  $this->conn->prepare($sql);
        return $stmt->execute([
            ':giohang_id' => $giohang_id,
            ':san_pham_id' => $san_pham_id,
            ':so_luong' => $so_luong
        ]);
    }
    public function findGioHangByUser($user_id)
    {
        $sql = "SELECT * FROM " . $this->tableGH . " WHERE user_id = :user_id LIMIT 1";

        $stmt =  $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function findChiTietGioHang($giohang_id, $san_pham_id)
    {
        $sql = "SELECT *
            FROM " . $this->tableGHCT .
            " WHERE giohang_id = :giohang_id
            AND san_pham_id = :san_pham_id";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute([
            ':giohang_id' => $giohang_id,
            ':san_pham_id' => $san_pham_id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function updateSoLuong($id)
    {
        $sql = "UPDATE " . $this->tableGHCT .
            " SET so_luong = so_luong + 1
            WHERE id = :id";
        $stmt =  $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public function syncGioHangTotals($giohang_id)
    {


        $sql = "UPDATE ." . $this->tableGH . " gh
            SET tong_san_pham = (
                    SELECT COALESCE(SUM(ghct.so_luong), 0)
                    FROM " . $this->tableGHCT . " ghct
                    WHERE ghct.giohang_id = gh.id
                ),
                tong_tien = (
                    SELECT COALESCE(SUM(ghct.so_luong * sp.gia), 0)
                    FROM " . $this->tableGHCT . " ghct
                    JOIN " . $this->tableSP . " sp ON sp.id = ghct.san_pham_id
                    WHERE ghct.giohang_id = gh.id
                )
            WHERE gh.id = :giohang_id";

        $stmt =  $this->conn->prepare($sql);
        return $stmt->execute([':giohang_id' => $giohang_id]);
    }
    public function clearCart($giohang_id)
    {
        $sql = "DELETE FROM " . $this->tableGHCT .
            " WHERE giohang_id = :giohang_id";


        $stmt =  $this->conn->prepare($sql);
        return $stmt->execute([':giohang_id' => $giohang_id]);
    }
    public function countCart($user_id)
    {
        $sql = "
  SELECT COUNT(DISTINCT ghct.san_pham_id) AS total
FROM " . $this->tableGH . " gh
JOIN " . $this->tableGHCT . " ghct
    ON gh.id = ghct.giohang_id
WHERE gh.user_id = :user_id";



        $stmt =  $this->conn->prepare($sql);
        $stmt->execute([':user_id' => $user_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)($row['total'] ?? 0);
    }
    public function delete_cart($id, $user_id)
    {
        $sql = "SELECT ghct.giohang_id
            FROM " . $this->tableGHCT . " ghct
            JOIN " . $this->tableGH . " gh ON gh.id = ghct.giohang_id
            WHERE ghct.id = :id AND gh.user_id = :user_id
            LIMIT 1";

        $stmt =  $this->conn->prepare($sql);
        $stmt->execute([':id' => $id, ':user_id' => $user_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        $giohang_id = (int)$row['giohang_id'];

        // mysqli_query(
        //     $this->conn,
        $deleteGHCT = "DELETE FROM " . $this->tableGHCT . " WHERE id = :id AND giohang_id = :giohang_id";

        $stmtDelete = $this->conn->prepare($deleteGHCT);
        $stmtDelete->execute([
            ':id' => $id,
            ':giohang_id' => $giohang_id
        ]);
        return $giohang_id;
    }

    public function modelUpdateSoLuong($id, $giohang_id, $sanPham_id, $so_luong, $user_id = 0)
    {

        $sql = "UPDATE " . $this->tableGHCT . " ghct
            JOIN " . $this->tableGH . " gh ON gh.id = ghct.giohang_id
            SET ghct.so_luong = :so_luong
            WHERE ghct.id = :id
              AND ghct.giohang_id = :giohang_id
              AND ghct.san_pham_id = :sanPham_id
              AND gh.user_id = :user_id";
        $stmt =  $this->conn->prepare($sql);
        $so_luong = max(1, (int)$so_luong);

        $stmt->execute([
            ':id' => $id,
            ':giohang_id' => $giohang_id,
            ':so_luong' => $so_luong,
            ':sanPham_id' => $sanPham_id,
            ':user_id' => $user_id
        ]);

        return $stmt->rowCount(); /// tra ve so dong dc cap nhap 1 la cap nhat khong la ko cap nhat
    }
    public function modelSacNhan($iddon)
    {
        // Lấy trạng thái hiện tại
        $sql = "SELECT trang_thai_id FROM orders WHERE id = :iddon";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':iddon' => $iddon]);

        $result =  $stmt->fetch(PDO::FETCH_ASSOC);
        $idTrangThai = $result['trang_thai_id'];

        if ((int)$idTrangThai === 5) {
            $sql = "UPDATE orders
            SET trang_thai_id = 6,
            payment_status = 1 
            WHERE id = :iddon";

            $stmt = $this->conn->prepare($sql);

            return $stmt->execute([
                ':iddon' => $iddon
            ]);
        } else {
            return false;
        }
    }
    public function modelHuyDon($iddon)
    {
        // Lấy trạng thái hiện tại của đơn
        $sql = "SELECT trang_thai_id FROM orders WHERE id = :iddon";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':iddon' => $iddon
        ]);

        $currentStatus = (int)$stmt->fetchColumn();

        // Chỉ được hủy khi trạng thái là 1, 2 hoặc 3
        if (!in_array($currentStatus, [1, 2, 3], true)) {
            return false;
        }

        // Cập nhật trạng thái thành Hủy (6)
        $sql = "UPDATE orders
            SET trang_thai_id = 8
            WHERE id = :iddon";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':iddon' => $iddon,
        ]);
    }
    public function modelHoanHang($iddon)
    {
        // Lấy trạng thái hiện tại của đơn
        $sql = "SELECT trang_thai_id FROM orders WHERE id = :iddon";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':iddon' => $iddon
        ]);

        $currentStatus = (int)$stmt->fetchColumn();

        // Chỉ được hủy khi trạng thái là 1, 2 hoặc 3
        if (!in_array($currentStatus, [6], true)) {
            return false;
        }

        // Cập nhật trạng thái thành Hủy (6)
        $sql = "UPDATE orders
            SET trang_thai_id = 9
            WHERE id = :iddon";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':iddon' => $iddon,
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
}
