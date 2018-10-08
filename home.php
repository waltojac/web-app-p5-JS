<html>
<body>
<h1>PHP Demo</h1>

<p>All tables..</p>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '.secret.php';

$db = new mysqli('cis.gvsu.edu', // hostname of db server
    $mysqluser, // your userid
    $mysqlpassword, // your password
    $mydbname);

printf('<table> <tr><th>Store</th><th>Manager</th><th>Address</th><th>Country</th></tr>');

$result = $db->query("SELECT * FROM store");
while ($row = $result->fetch_assoc()) {
    $man = $row['manager_staff_id'];
    $add = $row['address_id'];

    $storeStr = <<<LAKER
  		SELECT first_name, last_name
		FROM   staff
 		WHERE  staff_id = $man
LAKER;

    $store = $db->query($storeStr);
    $storeRow = $store->fetch_assoc();

    $addressStr = <<<LAKER
  		SELECT *
		FROM   address
 		WHERE  address_id = $add
LAKER;

    $address = $db->query($addressStr);
	$addressRow = $address->fetch_assoc();
	
	$cit = $addressRow['city_id'];

    $cityStr = <<<LAKER
			SELECT *
		  	FROM   city
		   	WHERE  city_id = $cit
LAKER;

    $city = $db->query($addressStr);
	$cityRow = $address->fetch_assoc();
	
	$countr = $cityRow['country_id'];

	$countryStr = <<<LAKER
			SELECT *
		  	FROM   country
		   	WHERE  country_id = $countr
LAKER;

    $country = $db->query($countryStr);
    $countryRow = $country->fetch_assoc();


    printf('<tr><td>%s</td><td>%s %s</td><td>%s, %s</td><td>%s</td></tr>',
        $row['store_id'], $storeRow['first_name'], $storeRow['last_name'], $addressRow['address'], $cityRow['city'], $countryRow['country']);
}
printf('</table>');
?>
</body>
</html>

