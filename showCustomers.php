<html>
<body>
<h1>MoviePlus Rental Stores</h1>

<p>Customers:</p>
<?php
$store = urldecode($_GET['storeId']);
printf('<p>Store ID: %s</p>', $store);

?>
</body>
</html>