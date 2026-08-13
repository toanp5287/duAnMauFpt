<?php
class Model_user
{
    private $conn;
    public function __construct()
    {
        $this->conn = mysqli_connect("localhost", "root", "", "ban_hang");
    }
    public function ModelDataUser()
    {
        $sql = "SELECT * FROM users";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
