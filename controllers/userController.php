<?php
    namespace userControl;
    use users;

    class userController
    {
        private $db;
        private $requestMethod;
        private $userId;
        private $user;

        function __construct($db, $requestMethod, $userId)
        {
            $this->db = $db;
            $this->requestMethod = $requestMethod;
            $this->userId = $userId;
            $this->user = new users($db);
        }

        public function processRequestforusers()
        {
            switch($this->requestMethod)
            {
                case 'GET':
                    if($this->userId)
                    {
                        $response = $this->user->findOne($this->userId);
                        $usrarr = array();
                        $usrarr['data'] = array();
                        foreach($response as $res)
                        {
                            $useritm = array('userSrno' => $res['userSrno'], 'username' => $res['username'], 'password' => $res['password']);
                            array_push($usrarr['data'], $useritm);
                        }
                        return json_encode($usrarr);
                    }
                    else
                    {
                        $response = $this->user->findAll();
                        $usrarr = array();
                        $usrarr['data'] = array();
                        foreach($response as $res)
                        {
                            $useritm = array('userSrno' => $res['userSrno'], 'username' => $res['username'], 'password' => $res['password']);
                            array_push($usrarr['data'], $useritm);
                        }
                        return json_encode($usrarr);
                    }
                    break;

                case 'POST':
                    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                    $this->user->insertIntoUsers($input);
                    $response['status_code_header'] = 'HTTP/1.1 201 Created';
                    $response['body'] = null;
                    $response = json_encode($response);
                    return $response;
                    break;  
            }
        }
    }

?>
