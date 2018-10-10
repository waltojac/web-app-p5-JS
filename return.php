<html>
<head>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
<h1>MoviePlus Rental</h1>

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
        echo $updateStr;
    }
    else {
        echo "Error: " . $str. "<br>" . $db->error;
    }

?>

</body>
</html>