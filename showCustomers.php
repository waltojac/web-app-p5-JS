<html>
<head>
    <link rel="stylesheet" href="stylesheet.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
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


printf('<h2>List of Customers at Store %s, %s</h2>', $address, $city);
printf('<h3>Customers with Outstanding Rentals</h3>');
printf('<table class="left"> <tr class="head"><th></th><th>Name</th><th>Email</th><th>Rental History</th><th>New Rental</th></tr>');
$i = 1;
$result1 = $db->query("SELECT * FROM customer c, rental r where c.store_id = $store and c.customer_id = r.customer_id and r.return_date is null group by c.customer_id order by c.last_name");
while ($row = $result1->fetch_assoc()) {
    printf('<tr><td>%d</td><td>%s %s</td><td>%s</td><td><a href="history.php?id=%s&name=%s">View</a></td><td><a href="new.php?id=%s&name=%s">Rent</a></td></tr>',
    $i++, $row['first_name'], $row['last_name'], $row['email'], $row['customer_id'], $row['first_name']." ".$row['last_name'], $row['customer_id'], $row['first_name']." ".$row['last_name']);
}
printf('</table>');


printf('<h3>Customers with NO Outstanding Rentals</h3>');
printf('<table class="left"> <tr class="head"><th></th><th>Name</th><th>Email</th><th>Rental History</th><th>New Rental</th></tr>');
$i = 1;

$storeStr = <<<LAKER
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

unset($row);
$result2 = $db->query($storeStr);
while ($row = $result2->fetch_assoc()) {
    printf('<tr><td>%d</td><td>%s %s</td><td>%s</td><td><a href="history.php?id=%s&name=%s">View</a></td><td><a href="new.php?id=%s&name=%s">Rent</a></td></tr>',
    $i++, $row['first_name'], $row['last_name'], $row['email'], $row['customer_id'], $row['first_name']." ".$row['last_name'], $row['customer_id'], $row['first_name']." ".$row['last_name']);
}
printf('</table>');



?>
</body>
</html>
