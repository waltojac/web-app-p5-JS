<html>
<body>
<h1>MoviePlus Rental Stores</h1>

<?php
$store = urldecode($_GET['storeId']);
$address = urldecode($_GET['addr']);
$city = urldecode($_GET['cit']);


printf('<h2>List of Customers at Store %s, %s</h2>', $address, $city);


?>
</body>
</html>