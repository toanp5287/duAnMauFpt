<?php

class Category
{
    private $modelSanPhamCattegori;
    private $modelSp;

    public function __construct()
    {
        $this->modelSanPhamCattegori = new Model_category();
        $this->modelSp = new Model_sanPham();
    }
    public function index()
    {
        $list = $this->modelSanPhamCattegori->Data_phan_loai_san_pham();
        $categories = $this->modelSp->dataLoaiHang();
        require __DIR__ . '/../views/category.php';
    }
    public function phan_loai()
    {
        $idLoaiHang = $_GET['id'] ?? '';
        if ($idLoaiHang !== '') {

            $list = $this->modelSanPhamCattegori->phan_loai('', $idLoaiHang);
            $categories = $this->modelSp->dataLoaiHang();

            require __DIR__ . '/../views/category.php';
        }
    }
}
