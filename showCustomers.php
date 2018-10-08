<html>
<body>
<h1>MoviePlus Rental Stores</h1>

<?php
$store = urldecode($_GET['storeId']);
$address = urldecode($_GET['addr']);



$storeStr = <<<LAKER
  		SELECT *
		FROM   store
 		WHERE  store_id = $store
LAKER;

    $storeQ = $db->query($storeStr);
    $storeRow = $storeQ->fetch_assoc();

printf('<h2>List of Customers at Store %s</h2>', $address);


?>
</body>
</html>