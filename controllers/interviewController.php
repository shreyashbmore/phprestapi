<?php

namespace interviewControl;
use interviews;

class interviewController
{
    private $conn;
    private $requestMethod;
    private $interviewSrno;
    private $interview;
    

    function __construct($db, $requestMethod, $interviewSrno)
    {
        $this->conn = $db;
        $this->requestMethod = $requestMethod;
        $this->interviewSrno = $interviewSrno;
        //$this->meetingStatus = $meetingStatus;
        $this->interview = new interviews($db);
    }

    public function processRequestForinterviews()
        {
            switch($this->requestMethod)
            {
                case 'GET':
                    if($this->meetingStatus or $this->interviewSrno)
                    {
                        $response = $this->interview->getSpecificInterviews($this->interviewSrno);
                        $usrarr = array();
                        $usrarr['data'] = array();
                        foreach($response as $res)
                        {
                            $useritm = array('interviewSrno' => $res['interviewSrno'], 'candidateName' => $res['candidateName'], 'candidatePhoto' => $res['candidatePhoto'], 'candidateYear' => $res['candidateYear'], 'candidateBranch' => $res['candidateBranch'], 'pannel' => $res['pannel'], 'review' => $res['review']);
                            array_push($usrarr['data'], $useritm);
                        }
                        http_response_code(200);
                        return json_encode($usrarr);
                    }
                    else
                    {
                        $response = $this->interview->getAllInterviews();
                        $usrarr = array();
                        $usrarr['data'] = array();
                        foreach($response as $res)
                        {
                            $useritm = array('interviewSrno' => $res['interviewSrno'], 'candidateName' => $res['candidateName'], 'candidatePhoto' => $res['candidatePhoto'], 'candidateYear' => $res['candidateYear'], 'candidateBranch' => $res['candidateBranch'], 'pannel' => $res['pannel'], 'review' => $res['review']);
                            array_push($usrarr['data'], $useritm);
                        }
                        http_response_code(200);
                        return json_encode($usrarr);
                    }
                    break;

                case 'POST':
                    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                    $this->interview->insertIntoInterviews($input);
                    http_response_code(201);
                    break;

                case 'PUT':
                    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                    $this->meeting->updateInterviews($input, $this->interviewSrno);
                    break;
            }
        }

}
?>