
<?php
    class attendances
    {
        private $conn;
        private $table = 'attendances';
        private $attendenceSrno;
        private $meetingSrno;
       


        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function getAllAttendances()
        {
            $sql = "select * from attendances;";
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function getSpecificAttendances($meetingSrno, $limit)
        {
            if($limit != null)
            {
                $sql = "select * from attendances order by attendanceSrno desc limit $limit;";
            }
            else if($meetingSrno != null)
            {
                $sql = "select attendances.* from attendances inner join meetings on attendances.meetingSrno = meetings.meetingSrno where meetings.meetingSrno = '$meetingSrno' and meetings.meetingStatus = 1;";
            }
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function insertIntoAttendances($arr)
        {
            $this->meetingSrno = $arr['meetingSrno'];
            $this->attendance = $arr['attendance'];
            $sql = "insert into attendances(meetingSrno, attendance) values('$this->meetingSrno', '$this->attendance');";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            http_response_code(201);
        }
    }
?>