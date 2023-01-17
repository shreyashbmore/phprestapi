<?php

use userControl\userController;
use meetingControl\meetingController;
use attendanceControl\AttendanceController;
use loginControl\loginController;
use detailControl\detailController;
use taskControl\taskController;
use pannelControl\pannelController;
use interviewControl\interviewController;
include_once('../restapi/core/initialize.php');

require_once(SITE_ROOT.DS.'controllers'.DS.'userController.php');
require_once(SITE_ROOT.DS.'controllers'.DS.'meetingController.php');
require_once(SITE_ROOT.DS.'controllers'.DS.'attendanceController.php');
require_once(SITE_ROOT.DS.'controllers'.DS.'loginController.php');
require_once(SITE_ROOT.DS.'controllers'.DS.'detailController.php');
require_once(SITE_ROOT.DS.'controllers'.DS.'taskController.php');
require_once(SITE_ROOT.DS.'controllers'.DS.'pannelController.php');
require_once(SITE_ROOT.DS.'controllers'.DS.'interviewController.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = explode( '/', $uri );

    switch($uri[3])
    {
        case 'users':
            $userId = null;
            if (isset($uri[4])) 
            {
                $userId = (int) $uri[4];
            }
            $requestMethod = $_SERVER["REQUEST_METHOD"];
            $controller = new userController($db, $requestMethod, $userId);
            $result =  $controller->processRequestforusers();
            echo $result;
            break;

        case 'meetings':
            $meetingSrno = null;
            $meetingStatus = null;
            if(isset($uri[4]))
            {
                $meetingSrno = (int) $uri[4];
            }
            if(isset($_GET['meetingStatus']))
            {
                $meetingStatus = $_GET['meetingStatus'];
            }
            $requestMethod = $_SERVER['REQUEST_METHOD'];
            $controller = new meetingController($db, $requestMethod, $meetingSrno, $meetingStatus);
            $result = $controller->processRequestForMeetings();
            echo $result;
            break;

        case 'attendances':
            $meetingSrno = null;
            $limit = null;
            if(isset($_GET['limit']))
            {
                $limit = $_GET['limit'];
            }
            if(isset($_GET['meetingSrno']))
            {
                $meetingSrno = $_GET['meetingSrno'];
            }
            $requestMethod = $_SERVER['REQUEST_METHOD'];
            $controller = new attendanceController($db, $requestMethod, $meetingSrno, $limit);
            $result = $controller->processRequestForAttendances();
            echo $result;
            break;

            case 'logins':
                $loginSrno = null;
             
                if(isset($_GET['loginSrno']))
                {
                    $loginSrno = $_GET['loginSrno'];
                }
             
                $requestMethod = $_SERVER['REQUEST_METHOD'];
                $controller = new loginController($db, $requestMethod, $loginSrno);
                $result = $controller->processRequestForLogins();
                echo $result;
                break;

            case 'details':
                $memberSrno = null;
             
                if(isset($_GET['memberSrno']))
                {
                    $memberSrno = $_GET['memberSrno'];
                }
             
                $requestMethod = $_SERVER['REQUEST_METHOD'];
                $controller = new detailController($db, $requestMethod, $memberSrno);
                $result = $controller->processRequestForDetails();
                echo $result;
                break;

                case 'tasks':
                    $taskSrno = null;
                 
                    if(isset($_GET['taskSrno']))
                    {
                        $taskSrno = $_GET['taskSrno'];
                    }
                 
                    $requestMethod = $_SERVER['REQUEST_METHOD'];
                    $controller = new taskController($db, $requestMethod, $taskSrno);
                    $result = $controller->processRequestForTasks();
                    echo $result;
                    break;
                    
                    case 'pannels':
                        $pannelSrno = null;
                     
                        if(isset($_GET['pannelSrno']))
                        {
                            $pannelSrno = $_GET['pannelSrno'];
                        }
                     
                        $requestMethod = $_SERVER['REQUEST_METHOD'];
                        $controller = new pannelController($db, $requestMethod, $pannelSrno);
                        $result = $controller->processRequestForPannels();
                        echo $result;
                        break;

                        case 'interviews':
                            $interviewSrno = null;
                         
                            if(isset($_GET['interviewSrno']))
                            {
                                $interviewSrno = $_GET['interviewSrno'];
                            }
                         
                            $requestMethod = $_SERVER['REQUEST_METHOD'];
                            $controller = new interviewController($db, $requestMethod, $interviewSrno);
                            $result = $controller->processRequestForInterviews();
                            echo $result;
                            break;
        default:
            header("HTTP/1.1 404 Not Found");
            exit();
    }
?>