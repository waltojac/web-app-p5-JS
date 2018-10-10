<html>
<head>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
<h1>MoviePlus Rental</h1>
<h3> Checkout Movie:</h3>
<?php
    session_start();
    $ti = urldecode($_GET['title']);
    $id = urldecode($_GET['inv']);
    printf('<table><tr><td>Customer</tb><td>%s</td></tr>', $_SESSION['cName']);
    printf('<tr><td>Movie Title</td><td>%s</td></tr>', $ti);
    printf('<tr><td>Inventory ID</td><td>%s</td></tr>', $id);




?>
</body>
</html>