<?php
    $id = urldecode($_GET['inv']);
    require_once '.secret.php';

    $db = new mysqli('cis.gvsu.edu', // hostname of db server
        $mysqluser, // your userid
        $mysqlpassword, // your password
        $mydbname);
    

    $man = urldecode($_GET['mId']);
    $custId = urldecode($_GET['cId']);
    $date = date('Y-m-d H:i:s');


    $str = "INSERT INTO rental (rental_date, inventory_id, customer_id, staff_id)
    VALUES ('$date', '$id', '$custId', '$man')";
    if ($db->query($str) === true){
        $msg->result = "success";
        print json_encode($msg);
    }
    else {
        $msg->result = "fail";
        print json_encode($msg);
    }

?>