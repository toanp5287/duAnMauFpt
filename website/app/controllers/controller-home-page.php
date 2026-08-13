<?php
// require_once __DIR__ . '/../models/model-home-page.php';
// require_once __DIR__ . '/../models/model-category.php';
class San_pham
{
    private $modelSanPham;
    private $modelRV;
    private $modelCategory;
    private $modelSanPhamCattegori;
    private $modelSp;
    public function __construct()
    {
        $this->modelSanPham = new Model_sanPham();
        $this->modelRV = new ModelReview();
        $this->modelCategory = new Model_category();
        $this->modelSanPhamCattegori = new Model_category();
        $this->modelSp = new Model_sanPham();
    }
    public function index()
    {
        // $loai_hang = $this->modelSanPham->data_loai_hang();
        $productsList = $this->modelSanPham->data_sanPham();
        $loai_hang =   $this->modelSanPham->dataLoaiHang();
        $categories = $this->modelSp->dataLoaiHang();

        $idLoaiHang = $_GET['id'] ?? '';
        if ($idLoaiHang !== '') {
            $list = $this->modelSanPhamCattegori->phan_loai('', $idLoaiHang);
        }
        require __DIR__ . "/../views/home_page.php";
    }
    public  function search()

    {
        $name = $_GET['name'] ?? '';
        $id_loai_hang = $_GET['loai_san_pham'] ?? '';
        $productsList = $this->modelSanPham->model_search($name, $id_loai_hang);
        // load category
        $categories = $this->modelSp->dataLoaiHang();

        $idLoaiHang = $_GET['id'] ?? '';
        if ($idLoaiHang !== '') {
            $list = $this->modelSanPhamCattegori->phan_loai('', $idLoaiHang);
        }
        $loai_hang = $this->modelSanPham->dataLoaiHang();
        require __DIR__ . '/../views/home_page.php';
    }
}
