<?php
# error_reporting(E_ALL);
# ini_set('display_errors', 1);
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

    require_once '.secret.php';

    $db = new mysqli('cis.gvsu.edu', // hostname of db server
        $mysqluser, // your userid
        $mysqlpassword, // your password
        $mydbname);
        
    $date = date('Y-m-d H:i:s');
    $rid = urldecode($_GET['rid']);
    
    $updateStr = <<<LAKER
        UPDATE rental
        SET return_date = "$date"
        WHERE rental_id =$rid
LAKER;

    if ($db->query($updateStr) === true){
        $msg->result = "success";
        print json_encode($msg);
    }
    else {
        $msg->result = "fail";
        print json_encode($msg);
    }
?>