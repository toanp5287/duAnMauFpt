<?php
class Data_san_pham
{
    private $conn;
    private $table = 'san_pham';
    public function __construct()
    {
        $model = new Database();
        $this->conn = $model->getConnection();
    }


    public function ModelSanPham()
    {
        $sql = "SELECT san_pham.*,loai_hang.ten_loai FROM " . $this->table . " JOIN loai_hang ON san_pham.loai_hang_id = loai_hang.id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function model_creat($ten_san_pham, $gia, $soluong, $mota, $loaihang_id, $hinhanh)
    {
        $sql = "INSERT INTO " . $this->table . "(ten_san_pham, gia, so_luong, mo_ta, loai_hang_id, hinh_anh)
        VALUES(:ten_san_pham, :gia, :soluong, :mota, :loaihang_id, :hinhanh)";
        $stmt = $this->conn->prepare($sql);

        return  $stmt->execute([
            ':ten_san_pham' => $ten_san_pham,
            ':gia' => $gia,
            ':soluong' => $soluong,
            ':mota' => $mota,
            ':loaihang_id' => $loaihang_id,
            ':hinhanh' => $hinhanh,
        ]);
    }
    public function model_delete($id)
    {
        $sql = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id' => $id
        ]);
    }
    public function model_update($id, $ten_san_pham, $gia, $soluong, $mota, $loaihang_id, $hinhanh)
    {
        if ($hinhanh !== "") {
            $sql = "UPDATE " . $this->table . " SET
            ten_san_pham = :ten_san_pham,
            gia = :gia,
            so_luong = :soluong,
            mo_ta = :mota,
            loai_hang_id = :loaihang_id,
            hinh_anh = :hinhanh
            WHERE id = :id";
        } else {
            $sql = "UPDATE " . $this->table . " SET
            ten_san_pham = :ten_san_pham,
            gia = :gia,
            so_luong = :soluong,
            mo_ta = :mota,
            loai_hang_id = :loaihang_id
            WHERE id = :id";
        }
        $stmt = $this->conn->prepare($sql);
        $params =  [
            ':id' => $id,
            ':ten_san_pham' => $ten_san_pham,
            ':gia' => $gia,
            ':soluong' => $soluong,
            ':mota' => $mota,
            ':loaihang_id' => $loaihang_id,
        ];
        if ($hinhanh !== '') {
            $params[':hinhanh'] = $hinhanh;
        }
        return  $stmt->execute($params);
    }
    public function find($id)
    {
        $sql = "SELECT san_pham.*, loai_hang.ten_loai
        FROM " . $this->table . "
        JOIN loai_hang
        ON san_pham.loai_hang_id = loai_hang.id
        WHERE san_pham.id = :id";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            'id' => $id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
