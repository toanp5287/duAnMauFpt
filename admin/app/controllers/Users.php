<?php
require_once __DIR__ . '/../models/Model-user.php';
class ControllerUsers
{
    public function index()
    {
        $model = new Model_user();
        $user = $model->ModelDataUser();
        require __DIR__ . '/../views/user.php';
    }
}
