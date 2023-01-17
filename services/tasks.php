<?php
    class tasks
    {
        private $conn;
        private $table = 'tasks';

        private $taskSrno;
        private $memberSrno; 
        private $deadline;
        private $taskStatus;
        private $eventSrno;
    
        
        public function __construct($db)
        {
            $this->conn =$db;
        }
        public function getAllTasks()
        {
            $sql = "select * from tasks;";
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function getSpecificTasks()
        {
            $memberSrno=null;
            $taskStatus=null;
            if($_GET['memberSrno'])
            {
            $sql = "select * from tasks where memberSrno = $memberSrno;";
            
            }
            elseif($_GET['taskStatus']){
                $sql = "select * from tasks where taskStatus = $taskStatus;";
            }
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        public function insertIntoTasks(array $arr)
        {
            $this->taskSrno = $arr['taskSrno'];
            $this->memberSrno = $arr['memberSrno'];
            $this->deadline = $arr['deadline'];
            $this->taskStatus = $arr['taskStatus'];
            $this->eventSrno = $arr['eventSrno'];
            
            $statement = "insert into `tasks`(memberSrno,deadline,taskStatus,eventSrno) values('this->taskSrno','this->memberSrno','this->deadline','this->taskStatus','this->eventSrno')";
            $statement = $this->conn->prepare($statement);
            $statement->execute();
            // return $statement->rowCount();
        }

        public function updateTasks($arr)
        {
            $this->taskSrno = $arr['taskSrno'];
            $this->memberSrno = $arr['memberSrno'];
            $this->deadline = $arr['deadline'];
            $this->taskStatus = $arr['taskStatus'];
            $this->eventSrno = $arr['eventSrno']; 

            $sql = "Update tasks set  'memberSrno=$this->memberSrno','deadline=$this->deadline','taskStatus=$this->taskStatus','eventSrno=$this->eventSrno' where taskSrno = '$taskSrno';";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        }

        public function delete($id)
        {
            $statement = "
                DELETE FROM tasks
                WHERE taskSrno = :id;
            ";
    
            try {
                $statement = $this->db->prepare($statement);
                $statement->execute(array('taskSrno' => $id));
                return $statement->rowCount();
            } catch (\PDOException $e) {
                exit($e->getMessage());
            }    
        }
    }
?>

