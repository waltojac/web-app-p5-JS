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
    if (!empty($ti) && !empty($id)){
        $_SESSION['title'] = "$ti";
        $_SESSION['id'] = "$id";
    }
    

    printf('<table><tr><td>Customer</tb><td>%s</td></tr>', $_SESSION['cName']);
    printf('<tr><td>Movie Title</td><td>%s</td></tr>',  $_SESSION['title']);
    printf('<tr><td>Inventory ID</td><td>%s</td></tr></table>', $_SESSION['id']);
?>
<form action="" method=:"POST">
    <input type="submit" name="doSearch" value="Confirm">
</form>
<?php
    session_start();
    if (isset($_GET['doSearch'])){
        print_r("Test");
    }

?>
</body>
</html>