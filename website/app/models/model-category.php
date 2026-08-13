<?php


class Model_category
{
    private $conn;
    private $table = 'san_pham';
    public function __construct()
    {
        $model = new Database();
        $this->conn = $model->getConnection();
    }

    public function Data_phan_loai_san_pham()
    {
        $sql = "SELECT * FROM " . $this->table;
        // Do không có tham số (tham số đầu vào) nên dùng mysqli_query là đủ an toàn
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function phan_loai($idSanPham, $idLoaiHang)
    {
        $sql = "SELECT san_pham.*, loai_hang.ten_loai
            FROM san_pham
            LEFT JOIN loai_hang 
            ON san_pham.loai_hang_id = loai_hang.id
            WHERE san_pham.loai_hang_id = :idLoaiHang";

        if (!empty($idSanPham)) {
            $sql .= " AND san_pham.id != :idSanPham";
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idLoaiHang', $idLoaiHang);

        if (!empty($idSanPham)) {
            $stmt->bindParam(':idSanPham', $idSanPham);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
