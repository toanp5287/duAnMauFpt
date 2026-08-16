<?php

class ControllerUsers
{
    public function index()
    {
        $model = new Model_user();

        $user = $model->ModelDataUser();
        $modelSanPham = new Data_san_pham();
        $listProductDelete = $modelSanPham->getAllDelete();
        $userXoaMen = $model->modelGetAllXoaMem();
        require_once __DIR__ . '/../views/user.php';
    }


    public function kick($id)
    {
        $model = new Model_user();

        $user = $model->userDetail($id);

        if (!$user) {

            header(
                "Location: index.php?controller=user&action=index"
            );

            exit;
        }


        // Không cho kick Admin

        if ((int)$user['role'] === 1) {

            $_SESSION['error'] =
                'Không thể kick tài khoản Admin.';

            header(
                "Location: index.php?controller=user&action=index"
            );

            exit;
        }


        $model->kickUser($id);

        $_SESSION['success'] =
            'Đã kick tài khoản thành công.';


        header(
            "Location: index.php?controller=user&action=index"
        );

        exit;
    }
    public function xoamem()
    {
        $idUser = $_GET['id'] ?? 0;

        if ($idUser <= 0) {
            header("Location: index.php?controller=user&action=index");
            exit;
        }

        $model = new Model_user();

        $result = $model->modelXoaMem($idUser);

        if ($result) {
            header("Location: index.php?controller=user&action=index");
            exit;
        }

        // Xóa thất bại
        header("Location: index.php?controller=user&action=index&error=xoa_mem");
        exit;
    }
    public function getAllDanhGia()
    {
        $model = new Model_user();
        $modelSanPham = new Data_san_pham();
        $listDanhGia = $model->modelgetAllDanhGia();
        // echo "<pre>";
        // print_r($listDanhGia);
        // echo "</pre>";
        // die();
        $listProductDelete = $modelSanPham->getAllDelete();
        $userXoaMen = $model->modelGetAllXoaMem();
        require_once __DIR__ . '/../views/danh_gia.php';
    }
    public function duyet()
    {
        $idDuyet = $_GET['id'] ?? 0;
        $model = new Model_user();
        $model->modelDuyet($idDuyet);
        header("Location: index.php?controller=user&action=getAllDanhGia");
        exit();
    }
    public function an()
    {
        $idAn = $_GET['id'] ?? 0;
        $model = new Model_user();
        $model->modelAn($idAn);
        header("Location: index.php?controller=user&action=getAllDanhGia");
        exit();
    }
}
