<?php

namespace taskControl;
use tasks;

class taskController
{
    private $conn;
    private $requestMethod;
    private $taskSrno;
    private $taskStatus;
    private $task;
   

    function __construct($db, $requestMethod, $taskSrno)
    {
        $this->conn = $db;
        $this->requestMethod = $requestMethod;
        $this->taskSrno = $taskSrno;
        $this->memberSrno = $memberSrno;
        $this->task = new tasks($db);
    }

    public function processRequestForTasks()
        {
            switch($this->requestMethod)
            {
                case 'GET':
                    if($this->taskSrno)
                    {
                        $response = $this->task->getSpecificTasks($this->taskSrno);
                        $usrarr = array();
                        $usrarr['data'] = array();
                        foreach($response as $res)
                        {
                            $useritm = array('taskSrno' => $res['taskSrno'],   'memberSrno' => $res['memberSrno'], 'deadline' => $res['deadline'], 'taskStatus' => $res['taskStatus'], 'eventSrno' => $res['eventSrno']);
                            array_push($usrarr['data'], $useritm);
                        }
                        http_response_code(200);
                        return json_encode($usrarr);
                    }
                    else
                    {
                        $response = $this->task->getAllTasks();
                        $usrarr = array();
                        $usrarr['data'] = array();
                        foreach($response as $res)
                        {
                            $useritm = array('taskSrno' => $res['taskSrno'],   'memberSrno' => $res['memberSrno'], 'deadline' => $res['deadline'], 'taskStatus' => $res['taskStatus'], 'eventSrno' => $res['eventSrno']);
                            array_push($usrarr['data'], $useritm);
                        }
                        http_response_code(200);
                        return json_encode($usrarr);
                    }
                    break;

                case 'POST':
                    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                    $this->task->insertIntoTasks($input);
                    http_response_code(201);
                    break;

                case 'PUT':
                    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                    $this->task->updateTasks($input, $this->taskSrno);
                    break;
            }
        }

}
?>