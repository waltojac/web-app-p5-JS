<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//header("Content-Type: application/json");
//header("Access-Control-Allow-Origin: *");
require_once '.secret.php';

$db = new mysqli('cis.gvsu.edu', // hostname of db server
    $mysqluser, // your userid
    $mysqlpassword, // your password
    $mydbname);



$store = urldecode($_GET['storeId']);

//Customers with outstanding rentals
$mainStr = <<<LAKER
    SELECT c.first_name, c.last_name, c.email, c.customer_id
    FROM customer c, rental r 
    WHERE c.store_id = $store 
    and c.customer_id = r.customer_id 
    and r.return_date is null 
    group by c.customer_id 
    order by c.last_name
LAKER;

$result1 = $db->query($mainStr);
$data1 = $result1->fetch_all(MYSQLI_ASSOC);
print json_encode($data1);



$i = 1;
/*
//No outstanding rentals
$secondStr = <<<LAKER
    SELECT * FROM customer c, rental r 
    WHERE c.store_id = $store 
    and c.customer_id = r.customer_id 
    and r.return_date is not null 
    and c.customer_id not in 
                            (SELECT r1.customer_id 
                            FROM rental r1 
                            WHERE c.customer_id = r1.customer_id 
                            and r1.return_date is null)
    GROUP BY c.customer_id 
    ORDER BY c.last_name
LAKER;

$result2 = $db->query($secondStr);
$data2 = $result2->fetch_all(MYSQLI_ASSOC);
print json_encode($data2);
*/
?>
