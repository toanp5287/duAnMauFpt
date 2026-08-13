<?php

class Loai_hang

{

    private $modelLoaiHang;
    public function __construct()
    {

        $this->modelLoaiHang = new ModelLoaihang();
    }
    public function index()
    {
        // checkLogin();
        $loai_hang = $this->modelLoaiHang->loaiHang();
        require __DIR__ . '/../views/list-loai-hang.php';
    }
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $ten_loai = $_POST['ten_loai'] ?? '';
            $this->modelLoaiHang->create_loai_hang($ten_loai);
            header("Location: index.php?controller=loai_hang&action=index");
            exit();
        }
        require __DIR__ . '/../views/create-loai-hang.php';
    }
    public function delete()
    {
        $id = $_GET['id'] ?? '';
        if ($id !== '') {

            $this->modelLoaiHang->delete_loai_hang($id);
            header("Location: index.php?controller=loai_hang&action=index");
            exit();
        }
    }
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $id = $_POST['id'] ?? '';
            $ten_loai = $_POST['ten_loai'] ?? '';
            if ($id !== '' & $ten_loai !== '') {
                $this->modelLoaiHang->update_loai_hang($id, $ten_loai);
                header("Location: index.php?controller=loai_hang&action=index");
                exit();
            }
        }
        $id = $_GET['id'] ?? '';
        if ($id !== '') {

            $id = $_GET['id'] ?? '';
            $list_loai = $this->modelLoaiHang->find($id);
            require __DIR__ . '/../views/update-loai-hang.php';
        }
    }
}
