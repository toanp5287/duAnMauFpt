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
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':email' => $email
        ]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($user && md5($password, $user['password'])) {
            return $user;
        }
        return false;
    }
    // public function data_dang_ky($email, $password)
    // {
    //     $email = mysqli_real_escape_string($this->conn, $email);

    //     // kiểm tra email tồn tại
    //     $check = "SELECT id FROM users WHERE email='$email'";

    //     $result = mysqli_query($this->conn, $check);

    //     if (mysqli_num_rows($result) > 0) {
    //         return "email_ton_tai";
    //     }

    //     $password = password_hash($password, PASSWORD_BCRYPT);

    //     $sql = "INSERT INTO users(email, password)
    //         VALUES('$email', '$password')";

    //     return mysqli_query($this->conn, $sql);
    // }
}
