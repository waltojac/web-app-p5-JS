<html>
<body>
<h1>MoviePlus Rental Stores</h1>

<?php
$store = urldecode($_GET['storeId']);
$address = urldecode($_GET['addr']);


printf('<h2>List of Customers at Store %s</h2>', $address);


?>
</body>
</html>