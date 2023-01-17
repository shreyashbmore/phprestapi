<?php
    class details
    {
        private $conn;
        private $table = 'details';

        private $memberSrno;
        private $name; 
        private $contact;
        private m;
        private f;
        private t;
        private a;
        private p;
        private i;

        private $loginSrno;  
        public function __construct($db)
        {
            $this->conn =$db;
        }
        public function getAllDetails()
        {
            $sql = "select * from details;";
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function getSpecificDetails($userId)
        {
            $sql = "select * from details where memberSrno = '$memberSrno';";
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        public function insertIntoDetails(array $arr)
        {
            $this->name = $arr['name'];
            $this->contact = $arr['contact'];
            $this->m = $arr['m'];
            $this->f = $arr['f'];
            $this->t = $arr['t'];
            $this->a = $arr['a'];
            $this->p = $arr['p'];
            $this->i = $arr['i'];

            $statement = "insert into `details`(name,contact,m,f,t,a,p,i) values('$this->name','$this->contact','0','0','0','0','0','0')";
            $statement = $this->conn->prepare($statement);
            $statement->execute();
            // return $statement->rowCount();
        }

        public function updateDetails($arr, $memberSrno)
        {
            if(isset($arr['m'] && $arr['f'] && $arr['t'] && $arr['a'] && $arr['p'] && $arr['i']))
            {
                $this->m = $arr['m'];
                $this->f = $arr['f']
                $this->t = $arr['t'];
                $this->a = $arr['a'];
                $this->p = $arr['p'];
                $this->i = $arr['i'];
                $sql = "Update details set m = '$this->m', f = '$this->f', t = '$this->t', a = '$this->a', p = '$this->p', i = '$this->i', where memberSrno = '$memberSrno';";
            }
         
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        }
        public function delete($id)
        {
            $statement = "
                DELETE FROM details
                WHERE memberSrno = :id;
            ";
    
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

