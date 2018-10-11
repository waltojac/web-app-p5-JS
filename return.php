<html>
<head>
    <link rel="stylesheet" href="stylesheet.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
</head>
<body>
<h1><a href="home.php" class="nav-link">MoviePlus Rental</a></h1>


<?php
    require_once '.secret.php';

    $db = new mysqli('cis.gvsu.edu', // hostname of db server
        $mysqluser, // your userid
        $mysqlpassword, // your password
        $mydbname);
        
    $date = date('Y-m-d H:i:s');
    $rid = urldecode($_GET['rid']);
    

    $updateStr = <<<LAKER
        UPDATE rental
        SET return_date = "$date"
        WHERE rental_id =$rid
LAKER;

    if ($db->query($updateStr) === true){
        printf('<p>Movie Checked-in Successfully.</p>');
    }
    else {
        echo "Error: " . $str. "<br>" . $db->error;
    }
    header('Location: history.php?success="true"');

?>

</body>
</html>