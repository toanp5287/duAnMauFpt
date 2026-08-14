<?php
class Data_auth
{
    private $conn;
    private $table;
    public function __construct()
    {
        $data = new Database();
        $this->conn = $data->getConnection();
    }
    public function data_login($email, $password)
    {
        $password = md5($password);
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':email' => $email
        ]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($user &&  $password ==  $user['password']) {

            return $user;
        }
        return false;
    }
}
