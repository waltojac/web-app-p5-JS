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
    $title = urldecode($_GET['title']);
    $rDate = urldecode($_GET['rDate']);

    $updateStr = <<<LAKER
    UPDATE inventory
    SET return_date = $date
    WHERE title = $title
    AND rental_date = $rDate
LAKER;

    if ($db->query($updateStr) === true){
        printf('<p>Movie Checked-in Successfully.</p>');
        echo $str;
    }
    else {
        echo "Error: " . $str. "<br>" . $db->error;
    }

?>

</body>
</html>