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

<form action="" method=:"GET">
Search for Movie Title:
    <input type="____" name="tname">
    <input type="submit" name="doSearch" value="Search">
</form>
<?php
require_once '.secret.php';

$db = new mysqli('cis.gvsu.edu', // hostname of db server
    $mysqluser, // your userid
    $mysqlpassword, // your password
    $mydbname);


$custId = urldecode($_GET['id']);
$custName = urldecode($_GET['name']);

printf('<h3>New Rental for Customer %s</h3>', $custName);
printf('<table> <tr><th>Title</th><th>Rating</th><th>Duration</th><th>Actors</th><th>Available Inventory</th></tr>');

if (isset($_GET['doSearch']) || $titleName == NULL) {
    $titleName = urldecode($_GET['tname']);
    printf('<p>Title: %s</p>', $titleName);
    $i = 1;
    $result = $db->query("SELECT * FROM rental where customer_id = $custId order by return_date");
    while ($row = $result->fetch_assoc()) {
        printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td>');
    }
} else {
    printf('<tr><td colspan="5" align="center">Nothing to Display.</td></tr>');
}

printf('</table>');


?>
</body>
</html>