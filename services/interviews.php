<?php
    class interviews
    {
        private $conn;
        private $table = 'interviews';
          
        private $interviewSrNo;
        private $candidateName; 
        private $candidatePhoto;
        private $candidateYear;
        private $candidateBranch;
        private $pannel;
        private $review;
        
        public function __construct($db)
        {
            $this->conn =$db;
        }
        public function getAllInterviews()
        {
            $sql = "select * from interviews;";
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function getSpecificInterviews($userId)
        {
            $sql = "select * from interviews where candidateName = '$name' order by interviewNo desc limit 1;";
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        public function insertIntoInterviews(array $arr)
        {
            $this->candidateName = $arr['candidateName'];
            $this->candidatePhoto = $arr['candidatePhoto'];
            $this->candidateYear= $arr['candidateYear'];
            $this->candidateBranch = $arr['candidateBranch'];
            $this->pannel = $arr['pannel'];
            $this->a = $arr['review'];
            

            $statement = "insert into `interviews`(candidateName,candidatePhoto,candidateYear,candidateBranch,pannel,review) values('$this->name','$this->contact','$this->candidateYear','$this->candidateBranch','$this->pannel','$this->review')";
            $statement = $this->conn->prepare($statement);
            $statement->execute();
            // return $statement->rowCount();
        }

        public function updateInterviews($arr, $interviewSrno)
        {
            if(isset($arr['review']))
            {
                $this->review = $arr['review'];
                $sql = "Update interviews set review = '$this->review' where interviewSrno = '$interviewSrno';";
            }
            elseif(isset($arr['review']))
            {
                $this->review = $arr['review'];
                $sql = "Update interviews set review = '$this->review' where interviewSrno = '$interviewSrno';";
            }
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        }

        public function delete($id)
        {
            $statement = "
                DELETE FROM interviews
                WHERE interviewSrno = :id;
            ";
    
            try {
                $statement = $this->db->prepare($statement);
                $statement->execute(array('interviewSrno' => $id));
                return $statement->rowCount();
            } catch (\PDOException $e) {
                exit($e->getMessage());
            }    
        }
    }
?>

