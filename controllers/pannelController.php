 <?php

namespace pannelControl;
use pannels;

class pannelController
{
    private $conn;
    private $requestMethod;
    private $memberSrno;
    private $pannel;
  
    function __construct($db, $requestMethod, $pannelSrno)
    {
        $this->conn = $db;
        $this->requestMethod = $requestMethod;
        $this->pannel = $pannel;
        $this->memberSrno = $memberSrno;
        $this->pannel = new pannels($db);
    }

    public function processRequestForPannels()
        {
            switch($this->requestMethod)
            {
                case 'GET':
                    if($this->memberSrno)
                    {
                        $response = $this->task->getSpecificPannels($this->memberSrno);
                        $usrarr = array();
                        $usrarr['data'] = array();
                        foreach($response as $res)
                        {
                            $useritm = array('pannel' => $res['pannel'],   'memberSrno' => $res['memberSrno']);
                            array_push($usrarr['data'], $useritm);
                        }
                        http_response_code(200);
                        return json_encode($usrarr);
                    }
                    else
                    {
                        $response = $this->task->getAllPannels();
                        $usrarr = array();
                        $usrarr['data'] = array();
                        foreach($response as $res)
                        {
                            $useritm = array('pannel' => $res['pannel'],   'memberSrno' => $res['memberSrno']);
                            array_push($usrarr['data'], $useritm);
                        }
                        http_response_code(200);
                        return json_encode($usrarr);
                    }
                    break;

                case 'POST':
                    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                    $this->task->insertIntoPannels($input);
                    http_response_code(201);
                    break;

                case 'PUT':
                    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                    $this->task->updatePannels($input, $this->taskSrno);
                    break;
            }
        }

}
?>