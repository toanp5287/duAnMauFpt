<?php

class Model_user
{
    private $conn;

    public function __construct()
    {
        $data = new Database();
        $this->conn = $data->getConnection();
    }

    public function ModelDataUser()
    {
        $sql = "SELECT * FROM users WHERE deleted=0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }
    public function userDetail($id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function kickUser($id)
    {
        $sql = "UPDATE users
            SET status = 0
            WHERE id = :id
            AND role != 1";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id' => $id
        ]);
    }
    public function modelXoaMem($id)
    {
        $sql = "UPDATE users 
            SET deleted = 1 
            WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id' => $id
        ]);
    }
    public function modelKhoiPhucUser($id)
    {
        $sql = "UPDATE users 
            SET deleted = 0 
            WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id' => $id
        ]);
    }
    public function modelGetAllXoaMem()
    {
        $sql = "SELECT *
            FROM users
            WHERE deleted = 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function modelgetAllDanhGia()
    {
        $sql = "SELECT 
                danh_gia.*,
                san_pham.ten_san_pham,
                users.name AS ten_khach_hang
            FROM danh_gia
            JOIN san_pham 
                ON danh_gia.san_pham_id = san_pham.id
            JOIN users 
                ON danh_gia.user_id = users.id
            ORDER BY danh_gia.created_at DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function modelDuyet($id)
    {
        $sql = "UPDATE danh_gia SET trang_thai_duyet=1 WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ":id" => $id
        ]);
    }
    public function modelAn($id)
    {
        $sql = "UPDATE danh_gia SET trang_thai_duyet=0 WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ":id" => $id
        ]);
    }
}
