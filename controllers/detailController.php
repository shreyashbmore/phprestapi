<?php

namespace detailControl;
use details;

class detailController
{
    private $conn;
    private $requestMethod;
    private $memberSrno;
    private $detail;
   

    function __construct($db, $requestMethod, $memberSrno)
    {
        $this->conn = $db;
        $this->requestMethod = $requestMethod;
        $this->memberSrno = $memberSrno;
        $this->detail = new details($db);
    }

    public function processRequestForDetails()
        {
            switch($this->requestMethod)
            {
                case 'GET':
                    if($this->memberSrno)
                    {
                        $response = $this->detail->getSpecificDetails($this->memberSrno);
                        $usrarr = array();
                        $usrarr['data'] = array();
                        foreach($response as $res)
                        {
                            $useritm = array('memberSrno' => $res['memberSrno'],   'name' => $res['name'], 'contact' => $res['contact'], 'm' => $res['m'], 'f' => $res['f'], 't' => $res['t'], 'a' => $res['a'], 'p' => $res['p'], 'i' => $res['i']);
                            array_push($usrarr['data'], $useritm);
                        }
                        http_response_code(200);
                        return json_encode($usrarr);
                    }
                    else
                    {
                        $response = $this->detail->getAllDetails();
                        $usrarr = array();
                        $usrarr['data'] = array();
                        foreach($response as $res)
                        {
                            $useritm = array('memberSrno' => $res['memberSrno'],   'name' => $res['name'], 'contact' => $res['contact'], 'm' => $res['m'], 'f' => $res['f'], 't' => $res['t'], 'a' => $res['a'], 'p' => $res['p'], 'i' => $res['i']);
                            array_push($usrarr['data'], $useritm);
                        }
                        http_response_code(200);
                        return json_encode($usrarr);
                    }
                    break;

                case 'POST':
                    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                    $this->detail->insertIntoDetails($input);
                    http_response_code(201);
                    break;

                case 'PUT':
                    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                    $this->detail->updateDetails($input, $this->memberSrno);
                    break;
            }
        }

}
?>