<?php
class Model_chi_tiet
{
    private $conn;
    private $table = 'san_pham';
    public function __construct()
    {
        $model = new Database();
        $this->conn = $model->getConnection();
    }
    public function chi_tiet($id)
    {
        $id = (int)$id;
        $sql = "SELECT san_pham.*, loai_hang.ten_loai
        FROM " . $this->table .
            " LEFT JOIN loai_hang 
        ON san_pham.loai_hang_id = loai_hang.id
        WHERE san_pham.id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
