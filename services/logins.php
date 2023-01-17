<?php
    class logins
    {
        private $conn;
        private $table = 'logins';

        private $loginSrno;  
        private $email;
        private $password;
        public function __construct($db)
        {
            $this->conn =$db;
        }
        public function getAllLogins()
        {
            $sql = "select * from logins;";
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function getSpecificLogins($email)
        {
            $sql = "select * from logins where email = '$email';";
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        public function insertIntoLogins(array $arr)
        {
            $this->email = $arr['email'];
            $this->password = $arr['password'];
            $statement = "insert into `logins`(email,password) values('$this->email','$this->password')";
            $statement = $this->conn->prepare($statement);
            $statement->execute();
            // return $statement->rowCount();
        }
    
        public function updateLogins($arr, $email)
        {
            if(isset($arr['password']))
            {
                $this->email = $arr['password'];
                $sql = "Update logins set password = '$this->password' where email = '$email';";
            }
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        }

        public function delete($id)
        {
            $statement = "
                DELETE FROM logins
                WHERE loginSrno = :id;
            ";
    
            try {
                $statement = $this->db->prepare($statement);
                $statement->execute(array('loginSrno' => $id));
                return $statement->rowCount();
            } catch (\PDOException $e) {
                exit($e->getMessage());
            }    
        }

    }
?>

