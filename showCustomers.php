<html>
<head>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
<h1>MoviePlus Rental</h1>

<?php
require_once '.secret.php';

$db = new mysqli('cis.gvsu.edu', // hostname of db server
    $mysqluser, // your userid
    $mysqlpassword, // your password
    $mydbname);


$store = urldecode($_GET['storeId']);
$address = urldecode($_GET['addr']);
$city = urldecode($_GET['cit']);
$man = urldecode($_GET['man']);
session_start();
$_SESSION['managerId'] = $man;


printf('<h3>List of Customers with Outstanding Rentals at Store %s, %s</h3>', $address, $city);
printf('<table class="left"> <tr class="head"><th></th><th>Name</th><th>Email</th><th>Rental History</th><th>New Rental</th></tr>');
$i = 1;
$result = $db->query("SELECT * FROM customer c, rental r where c.store_id = $store and c.customer_id = r.customer_id and r.return_date is null group by c.customer_id order by c.last_name");
while ($row = $result->fetch_assoc()) {
    printf('<tr><td>%d</td><td>%s %s</td><td>%s</td><td><a href="history.php?id=%s&name=%s">View</a></td><td><a href="new.php?id=%s&name=%s">Rent</a></td></tr>',
    $i++, $row['first_name'], $row['last_name'], $row['email'], $row['customer_id'], $row['first_name']." ".$row['last_name'], $row['customer_id'], $row['first_name']." ".$row['last_name']);
    
}
print_r($db->error);
printf('</table>');

$row->free();

printf('<h3>List of Customers with NO Outstanding Rentals at Store %s, %s</h3>', $address, $city);
printf('<table class="left"> <tr class="head"><th></th><th>Name</th><th>Email</th><th>Rental History</th><th>New Rental</th></tr>');
$i = 1;
$result = $db->query("SELECT * FROM customer where store_id = $store and return_date is not null order by last_name");
while ($row = $result->fetch_assoc()) {
    printf('<tr><td>%d</td><td>%s %s</td><td>%s</td><td><a href="history.php?id=%s&name=%s">View</a></td><td><a href="new.php?id=%s&name=%s">Rent</a></td></tr>',
    $i++, $row['first_name'], $row['last_name'], $row['email'], $row['customer_id'], $row['first_name']." ".$row['last_name'], $row['customer_id'], $row['first_name']." ".$row['last_name']);
}
printf('</table>');



?>
</body>
</html>
