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

printf('<h3>New Rental for customer %s</h3>', $custName);
printf('<table> <tr><th>Name</th><th>Email</th><th>Rental History</th><th>New Rental</th></tr>');


?>
</body>
</html>