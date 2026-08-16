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
        $sql = "SELECT * FROM users WHERE deleted=0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }
    public function userDetail($id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function kickUser($id)
    {
        $sql = "UPDATE users
            SET status = 0
            WHERE id = :id
            AND role != 1";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id' => $id
        ]);
    }
    public function modelXoaMem($id)
    {
        $sql = "UPDATE users 
            SET deleted = 1 
            WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id' => $id
        ]);
    }
    public function modelKhoiPhucUser($id)
    {
        $sql = "UPDATE users 
            SET deleted = 0 
            WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id' => $id
        ]);
    }
    public function modelGetAllXoaMem()
    {
        $sql = "SELECT *
            FROM users
            WHERE deleted = 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
