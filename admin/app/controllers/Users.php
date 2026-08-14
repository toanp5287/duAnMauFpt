<?php
class ControllerUsers
{
    public function index()
    {
        $model = new Model_user();
        $user = $model->ModelDataUser();

        require_once __DIR__ . '/../views/user.php';
    }
}
