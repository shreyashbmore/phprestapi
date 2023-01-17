<?php

namespace attendanceControl;
use attendances;

class AttendanceController
{
    private $conn;
    private $requestMethod;
    private $meetingSrno;
    private $limit;
    private $attendance;

    public function __construct($db, $requestMethod, $meetingSrno, $limit)
    {
        $this->conn = $db;
        $this->requestMethod = $requestMethod;
        $this->meetingSrno = $meetingSrno;
        $this->limit = $limit;
        $this->attendance = new attendances($this->conn);
    }

    public function processRequestForAttendances()
    {
        switch($this->requestMethod)
        {
            case 'GET':
                if($this->meetingSrno or $this->limit)
                    {
                        $response = $this->attendance->getSpecificAttendances($this->meetingSrno, $this->limit);
                        $usrarr = array();
                        $usrarr['data'] = array();
                        foreach($response as $res)
                        {
                            $useritm = array('attendanceSrno' => $res['attendanceSrno'],  'meetingSrno' => $res['meetingSrno'], 'attendance' => $res['attendance']);
                            array_push($usrarr['data'], $useritm);
                        }
                        http_response_code(200);
                        return json_encode($usrarr);
                    }
                    else
                    {
                        $response = $this->attendance->getAllAttendances();
                        $usrarr = array();
                        $usrarr['data'] = array();
                        foreach($response as $res)
                        {
                            $useritm = array('attendanceSrno' => $res['attendanceSrno'],  'meetingSrno' => $res['meetingSrno'], 'attendance' => $res['attendance']);
                            array_push($usrarr['data'], $useritm);
                        }
                        http_response_code(200);
                        return json_encode($usrarr);
                    }
                break;

            case 'POST':
                $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                $this->attendance->insertIntoAttendances($input);
                http_response_code(201);
                break;
        }
    }
}
?>