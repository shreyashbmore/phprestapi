<?php
    class meetings
    {
        private $conn;
        private $meetingSrno;
        private $meetingDate;
        private $meetingTime;
        private $meetingAgenda;
        private $meetingLocation;
        private $meetingStatus;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function getAllMeetings()
        {
            $sql = "select * from meetings;";
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function getSpecificMeetings($id, $ms)
        {
            if($ms == null)
            {
                $sql = "select * from meetings where meetingSrno = '$id';";
            }
            else
            {
                $sql = "select * from meetings where meetingStatus = '$ms';";
            }
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function insertIntoMeetings($arr)
        {
            $this->meetingDate = $arr['meetingDate'];
            $this->meetingTime = $arr['meetingTime'];
            $this->meetingAgenda = $arr['meetingAgenda'];
            $this->meetingLocation = $arr['meetingLocation'];
            $sql = "Insert into meetings(meetingDate, meetingTime, meetingAgenda, meetingLocation, meetingStatus) values ('$this->meetingDate', '$this->meetingTime', '$this->meetingAgenda', '$this->meetingLocation', '0');";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        }

        public function updateMeetings($arr, $meetingSrno)
        {
            if(isset($arr['meetingAgenda']))
            {
                $this->meetingAgenda = $arr['meetingAgenda'];
                $sql = "Update meetings set meetingAgenda = '$this->meetingAgenda' where meetingSrno = '$meetingSrno';";
            }
            elseif(isset($arr['meetingStatus']))
            {
                $this->meetingStatus = $arr['meetingStatus'];
                $sql = "Update meetings set meetingStatus = '$this->meetingStatus' where meetingSrno = '$meetingSrno';";
            }
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        }
    }
?>