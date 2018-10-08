<html>
<body>
<h1>MoviePlus Rental Stores</h1>

<?php
require_once '.secret.php';

$db = new mysqli('cis.gvsu.edu', // hostname of db server
    $mysqluser, // your userid
    $mysqlpassword, // your password
    $mydbname);

printf('<table> <tr><th>Name</th><th>Email</th><th>Rental History</th><th>New Rental</th></tr>');

$store = urldecode($_GET['storeId']);
$address = urldecode($_GET['addr']);
$city = urldecode($_GET['cit']);


printf('<h2>List of Customers at Store %s, %s</h2>', $address, $city);


?>
</body>
</html>