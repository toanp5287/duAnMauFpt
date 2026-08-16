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

    // Lấy tất cả sản phẩm chưa xóa
    public function Data_phan_loai_san_pham()
    {
        $sql = "SELECT *
                FROM {$this->table}
                WHERE da_xoa = 0";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy sản phẩm cùng loại - chỉ lấy sản phẩm chưa xóa
    public function phan_loai($idSanPham, $idLoaiHang)
    {
        $sql = "SELECT san_pham.*, loai_hang.ten_loai
                FROM san_pham
                LEFT JOIN loai_hang
                ON san_pham.loai_hang_id = loai_hang.id
                WHERE san_pham.loai_hang_id = :idLoaiHang
                AND san_pham.da_xoa = 0";

        // Không lấy chính sản phẩm hiện tại
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
