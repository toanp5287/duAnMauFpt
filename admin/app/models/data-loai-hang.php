<?php
class ModelLoaihang
{
    private $conn;
    private $table = "loai_hang";

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }
    public function loaiHang()
    {
        $sql = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function create_loai_hang($ten_loai)
    {
        $sql = "INSERT INTO {$this->table} (ten_loai) VALUES (:ten_loai)";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':ten_loai' => $ten_loai
        ]);
    }
    public function delete_loai_hang($id)
    {
        //     $sql = "DELETE FROM" . $this->table . " WHERE id='$id'";
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function update_loai_hang($id, $ten_loai)
    {

        $sql = "UPDATE {$this->table} SET ten_loai= :ten_loai WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':ten_loai' => $ten_loai
        ]);
    }
    public function find($id)
    {

        $sql = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
