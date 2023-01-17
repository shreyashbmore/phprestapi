<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/initialize.php');
$user = new users($db);

$result = $user->findall();

    $usrarr = array();
    $usrarr['data'] = array();

    foreach($result as $res)
    {
        $useritm = array('userSrno' => $res['userSrno'], 'username' => $res['username'], 'password' => $res['password']);
        array_push($usrarr['data'], $useritm);
    }

    echo json_encode($usrarr);
?>