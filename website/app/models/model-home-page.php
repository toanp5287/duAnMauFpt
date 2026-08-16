<?php

class Model_sanPham
{
    private $conn;
    private $table = 'san_pham';
    private $tableLoaiHang = 'loai_hang';

    public function __construct()
    {
        $model = new Database();
        $this->conn = $model->getConnection();
    }

    // Lấy sản phẩm chưa xóa mềm
    public function data_sanPham()
    {
        $sql = "SELECT *
                FROM {$this->table}
                WHERE da_xoa = 0
                LIMIT 4";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy loại hàng
    public function dataLoaiHang()
    {
        $sql = "SELECT *
                FROM {$this->tableLoaiHang}";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tìm kiếm sản phẩm chưa xóa mềm
    public function model_search($name, $id_loai_hang)
    {
        $sql = "SELECT *
                FROM {$this->table}
                WHERE da_xoa = 0";

        $params = [];

        if (!empty($name)) {
            $sql .= " AND ten_san_pham LIKE :name";
            $params[':name'] = "%{$name}%";
        }

        if (!empty($id_loai_hang)) {
            $sql .= " AND loai_hang_id = :id_loai_hang";
            $params[':id_loai_hang'] = $id_loai_hang;
        }

        $sql .= " LIMIT 5";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
