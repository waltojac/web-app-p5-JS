<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '.secret.php';

$db = new mysqli('cis.gvsu.edu', // hostname of db server
    $mysqluser, // your userid
    $mysqlpassword, // your password
    $mydbname);

	$mainQry = <<<LAKER
		SELECT stor.store_id, staf.first_name, staf.last_name, a.address, c.city, co.country, stor.manager_staff_id
		FROM store stor, staff staf, address a, city c, country co
		WHERE staf.staff_id = stor.manager_staff_id
		AND stor.address_id = a.address_id
		AND a.city_id = c.city_id
		AND c.country_id = co.country_id
		GROUP BY stor.store_id
LAKER;


$result = $db->query($mainQry);
$data = $result->fetch_all(MYSQLI_ASSOC);
print json_encode($data);
?>
