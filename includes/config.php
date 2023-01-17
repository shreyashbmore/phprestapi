<?php
    $db_host = 'localhost';
    $db_user = "root";
    $db_password = "";
    $db_name = "restapi";

    $db = new PDO('mysql:host='.$db_host.'; dbname='.$db_name.';port=3306', $db_user, $db_password);

    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    define('APP_NAME', 'API TESTING');
?>