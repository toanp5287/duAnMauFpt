<?php

class Model_user
{
    private $conn;

    public function __construct()
    {
        $data = new Database();
        $this->conn = $data->getConnection();
    }

    public function ModelDataUser()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
