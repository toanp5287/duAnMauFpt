<?php
class Model_login_khach_hang
{
    private $conn;
    private $table = 'users';
    public function __construct()
    {
        $model = new Database();
        $this->conn = $model->getConnection();
    }
    public function data_dang_ky_khach_hang($name, $email, $password, $phone, $role)
    {
        // kiểm tra email đã tồn tại chưa
        $check = $this->conn->prepare(
            "SELECT id FROM {$this->table} WHERE email = :email"
        );

        $check->execute([
            ':email' => $email
        ]);

        if ($check->fetch()) {
            return false;
        }
        $password  = md5($password);
        $sql = "INSERT INTO {$this->table}
            (name, email, password, phone, role)
            VALUES
            (:name, :email, :password, :phone, :role)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $password,
            ':phone' => $phone,
            ':role' => $role
        ]);
    }
    public function login_khach_hang($email, $password)
    {

        $sql = "SELECT * FROM " . $this->table . " WHERE email = :email LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':email' => $email
        ]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        // if ($user && password_verify($password, $user['password'])) {
        //     return $user;
        // }
        if ($user && md5($password) === $user['password']) {
            return $user;
        }
        return false;
    }
    public function modelDataUser($id)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function updateUser($name, $email, $phone, $userId)
    {
        $sql = "UPDATE " . $this->table . " SET name = :name, email = :email, phone = :phone WHERE id = :userId";
        $stmt =  $this->conn->prepare($sql);
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':userId' => $userId
        ]);
    }
    public function findPassword($password, $userId)
    {
        $sql = 'SELECT * FROM users WHERE id = :userId';

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':userId' => $userId
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return false;
        }

        return md5($password) === $result['password'];
    }
    public function updateMK($password, $userId)
    {
        // echo $password;
        // echo $userId;
        // die();
        $password = md5($password);

        $sql = "UPDATE users
            SET password = :password
            WHERE id = :userId";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':password' => $password,
            ':userId' => $userId
        ]);
    }
}
