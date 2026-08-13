<?php
class Model_sanPham
{
    private $conn;
    private $table = 'san_pham';
    private $tableLoaiHang = 'loai_hang';
    public function __construct()
    {
        $model =  new Database();
        $this->conn = $model->getConnection();
    }
    public function data_sanPham()
    {
        $sql = "SELECT * FROM " . $this->table . " LIMIT 4";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function dataLoaiHang()
    {
        $sql = "SELECT * FROM " . $this->tableLoaiHang;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function model_search($name, $id_loai_hang)
    {
        $sql = "SELECT * FROM {$this->table} WHERE 1";
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
