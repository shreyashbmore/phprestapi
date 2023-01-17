<?php

namespace meetingControl;
use meetings;

class meetingController
{
    private $conn;
    private $requestMethod;
    private $meetingSrno;
    private $meeting;
    private $meetingStatus;

    function __construct($db, $requestMethod, $meetingSrno, $meetingStatus)
    {
        $this->conn = $db;
        $this->requestMethod = $requestMethod;
        $this->meetingSrno = $meetingSrno;
        $this->meetingStatus = $meetingStatus;
        $this->meeting = new meetings($db);
    }

    public function processRequestForMeetings()
        {
            switch($this->requestMethod)
            {
                case 'GET':
                    if($this->meetingStatus or $this->meetingSrno)
                    {
                        $response = $this->meeting->getSpecificMeetings($this->meetingSrno, $this->meetingStatus);
                        $usrarr = array();
                        $usrarr['data'] = array();
                        foreach($response as $res)
                        {
                            $useritm = array('meetingSrno' => $res['meetingSrno'], 'meetingDate' => $res['meetingDate'], 'meetingTime' => $res['meetingTime'], 'meetingAgenda' => $res['meetingAgenda'], 'meetingLocation' => $res['meetingLocation'], 'meetingStatus' => $res['meetingStatus']);
                            array_push($usrarr['data'], $useritm);
                        }
                        http_response_code(200);
                        return json_encode($usrarr);
                    }
                    else
                    {
                        $response = $this->meeting->getAllMeetings();
                        $usrarr = array();
                        $usrarr['data'] = array();
                        foreach($response as $res)
                        {
                            $useritm = array('meetingSrno' => $res['meetingSrno'], 'meetingDate' => $res['meetingDate'], 'meetingTime' => $res['meetingTime'], 'meetingAgenda' => $res['meetingAgenda'], 'meetingLocation' => $res['meetingLocation'], 'meetingStatus' => $res['meetingStatus']);
                            array_push($usrarr['data'], $useritm);
                        }
                        http_response_code(200);
                        return json_encode($usrarr);
                    }
                    break;

                case 'POST':
                    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                    $this->meeting->insertIntoMeetings($input);
                    http_response_code(201);
                    break;

                case 'PUT':
                    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                    $this->meeting->updateMeetings($input, $this->meetingSrno);
                    break;
            }
        }

}
?>