<?php
    class users
    {
        private $conn;
        private $table = 'users';

        public $userSrno;
        public $username;
        public $password;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function findAll()
        {
            $sql = "select * from users;";
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function findOne($userId)
        {
            $sql = "select * from users where userSrno = '$userId';";
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function insertIntoUsers(array $arr)
        {
            $this->username = $arr['username'];
            $this->password = $arr['password'];
            $statement = "insert into `users`(username,password) values('$this->username','$this->password')";
            $statement = $this->conn->prepare($statement);
            $statement->execute();
            // return $statement->rowCount();
        }
    }
?>