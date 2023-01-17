<?php
    class pannels

    {
        private $conn;
        private $table = 'pannels';
      
        private $memberSrno;
        private $pannel;
        
        public function __construct($db)
        {
            $this->conn =$db;
        }
        public function getAllPnnels()
        {
            $sql = "select * from pannels;";
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function getSpecificPannels()
        {
            $memberSrno=null;
            $pannel=null;
            if($_GET['memberSrno'])
            {
            $sql = "select * from pannels where memberSrno = $memberSrno;";
            
            }
            elseif($_GET['pannel']){
                $sql = "select * from tasks where pannel = $pannel;";
            }
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function insertIntoPannels(array $arr)
        {
            $this->memberSrno = $arr['memberSrno'];
            $this->pannel = $arr['pannel'];
          
            $statement = "insert into `pannels`(memberSrno,pannel) values('$this->memberSrno','$this->pannel')";
            $statement = $this->conn->prepare($statement);
            $statement->execute();
            // return $statement->rowCount();
        }
       
        public function delete($id)
        {
            $statement = "
                DELETE FROM pannels
                WHERE memberSrno = :id;";
    
            try {
                $statement = $this->db->prepare($statement);
                $statement->execute(array('memberSrno' => $id));
                return $statement->rowCount();
            } catch (\PDOException $e) {
                exit($e->getMessage());
            }    
        }
    }
?>

