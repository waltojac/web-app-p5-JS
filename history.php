<html>
<head>
  <style>
    tr:nth-child(odd) {
        background-color: wheat;
    }
	tr:nth-child(1) {
		background-color: black;
		color: white;
	}
    tr:nth-child(even) {
        background-color: palegreen;
    }
  </style>
</head>
<body>
<h1>MoviePlus Rental</h1>

<?php
require_once '.secret.php';

$db = new mysqli('cis.gvsu.edu', // hostname of db server
    $mysqluser, // your userid
    $mysqlpassword, // your password
    $mydbname);


$custId = urldecode($_GET['id']);
$custName = urldecode($_GET['name']);

printf('<h3>History for customer %s</h3>', $custName);

printf('<table> <tr><th>Film Title/th><th>Rental Date</th><th>Return Date</th></tr>');

$i = 1;
$result = $db->query("SELECT * FROM rental where customer_id = $custId order by return_date");
while ($row = $result->fetch_assoc()) {
    printf('<tr><td>%d %s</td><td>%s</td><td>%s</td></tr>', $i++, $row['inventory_id'], $row['rental_date'], $row['return_date']);
}


?>
</body>
</html>