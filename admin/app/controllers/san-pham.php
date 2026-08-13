<?php
class San_pham
{
    private $modelSanPham;
    private $modelLoaiHang;
    public function __construct()
    {

        $this->modelSanPham = new Data_san_pham();
        $this->modelLoaiHang = new ModelLoaihang();
    }
    public function index()
    {
        checkLogin();
        $product = $this->modelSanPham->ModelSanPham();
        require __DIR__ . '/../views/index-product.php';
    }
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $ten_san_pham = $_POST['ten_san_pham'] ?? '';
            $gia = $_POST['gia'] ?? '';
            $soluong = $_POST['so_luong'] ?? '';
            $mota = $_POST['mo_ta'] ?? '';
            $loaihang = $_POST['loai_hang'] ?? '';
            $hinhanh = '';

            if (isset($_FILES['hinh_anh']) && $_FILES['hinh_anh']['error'] == 0) {
                $upload_dir = __DIR__ . '/../../public/uploads/';
                // tạo thư mục nếu chưa có
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                $hinhanh = time() . '_' . $_FILES['hinh_anh']['name'];
                move_uploaded_file(
                    $_FILES['hinh_anh']['tmp_name'],
                    $upload_dir . $hinhanh
                );
            }
            $this->modelSanPham->model_creat($ten_san_pham, $gia, $soluong, $mota, $loaihang, $hinhanh);
            header("Location: index.php?controller=san_pham&action=index");
            exit();
        }
        $list_loai = $this->modelLoaiHang->loaiHang();
        require __DIR__ . '/../views/create.php';
    }
    public function delete()
    {
        $id = $_GET['id'] ?? '';
        $hinhanh = $this->modelSanPham->find($id);
        $img = $hinhanh['hinh_anh'];
        unlink(__DIR__ . '/../../public/uploads/' . $img);
        if ($id !== '') {
            $this->modelSanPham->model_delete($id);
            header("Location: index.php?controller=san_pham&action=index");
            exit();
        }
    }
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $id = $_POST['id'] ?? '';
            $ten_san_pham = $_POST['ten_san_pham'] ?? '';
            $gia = $_POST['gia'] ?? '';
            $soluong = $_POST['so_luong'] ?? '';
            $mota = $_POST['mo_ta'] ?? '';
            $loaihang = $_POST['loai_hang_id'] ?? '';

            $sanPham = $this->modelSanPham->find($id);
            $hinhanh = $sanPham['hinh_anh']; // mặc định là ảnh cũ

            if (!empty($_FILES['hinh_anh']['name'])) {
                $upload_dir = __DIR__ . '/../../public/uploads/';
                unlink($upload_dir . $hinhanh);


                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }

                $hinhanh = time() . '_' . $_FILES['hinh_anh']['name'];

                move_uploaded_file(
                    $_FILES['hinh_anh']['tmp_name'],
                    $upload_dir . $hinhanh
                );
            }
            $this->modelSanPham->model_update($id, $ten_san_pham, $gia, $soluong, $mota, $loaihang, $hinhanh);
            header("Location: index.php?controller=san_pham&action=index");
            exit();
        }
        $id = $_GET['id'] ?? '';
        if ($id !== '') {
            $san_pham_update  = $this->modelSanPham->find($id);
            $list_loai = $this->modelLoaiHang->loaiHang();
            require __DIR__ . '/../views/update.php';
        }
    }
}
