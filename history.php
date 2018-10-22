<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
require_once '.secret.php';

$db = new mysqli('cis.gvsu.edu', // hostname of db server
    $mysqluser, // your userid
    $mysqlpassword, // your password
    $mydbname);

$custId = urldecode($_GET['id']);

$searchStr = <<<LAKER
    SELECT f.title, r.rental_date, r.rental_id, r.return_date
    FROM rental r, inventory i, film f
    WHERE r.customer_id = $custId 
    AND r.inventory_id = i.inventory_id
    AND i.film_id = f.film_id
    ORDER BY r.return_date
LAKER;

$result = $db->query($searchStr);
$data = $result->fetch_all(MYSQLI_ASSOC);
print json_encode($data);

?>