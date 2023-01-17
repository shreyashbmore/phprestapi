<?php

namespace loginControl;
use logins;

class loginController
{
    private $conn;
    private $requestMethod;
    private $loginSrno;  
    private $email;
    private $password;

    function __construct($db, $requestMethod, $loginSrno, $email)
    {
        $this->conn = $db;
        $this->requestMethod = $requestMethod;
        $this->loginSrno = $loginSrno;
        $this->email = $email;
        $this->login = new logins($db);
    }

    public function processRequestForLogins()
        {
            switch($this->requestMethod)
            {
                case 'GET':
                    if($this->email)
                    {
                        $response = $this->login->getSpecificLogins($this->email);
                        $usrarr = array();
                        $usrarr['data'] = array();
                        foreach($response as $res)
                        {
                            $useritm = array('loginSrno' => $res['loginSrno'], 'email' => $res['email'], 'password' => $res['password']);
                            array_push($usrarr['data'], $useritm);
                        }
                        http_response_code(200);
                        return json_encode($usrarr);
                    }
                    else
                    {
                        $response = $this->login->getAllLogins();
                        $usrarr = array();
                        $usrarr['data'] = array();
                        foreach($response as $res)
                        {
                            $useritm = array('loginSrno' => $res['loginSrno'], 'email' => $res['email'], 'password' => $res['password']);
                            array_push($usrarr['data'], $useritm);
                        }
                        http_response_code(200);
                        return json_encode($usrarr);
                    }
                    break;

                case 'POST':
                    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                    $this->meeting->insertIntoLogins($input);
                    http_response_code(201);
                    break;

                case 'PUT':
                    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                    $this->meeting->updateLogins($input, $this->email);
                    break;
            }
        }

}
?>