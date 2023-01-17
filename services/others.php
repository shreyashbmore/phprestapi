<?php
    class others

    {
        private $conn;
        private $table = 'others';
        
        private $totalAmount;
        private $attend; 
        private $qr;
        private $pannelCount;
      
        public function __construct($db)
        {
            $this->conn =$db;
        }
        public function findAll()
        {
            $sql = "select * from others;";
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
?>

