<html>
<head>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
<h1>MoviePlus Rental</h1>
<?php
$custId = urldecode($_GET['id']);
$custName = urldecode($_GET['name']);

if (!empty($custId) && !empty($custName)){
    session_start();
    $_SESSION['cName'] = "$custName";
    $_SESSION['cId'] = "$custId";
}
?>
<form action="" method=:"GET">
Search for Movie Title:
    <input type="____" name="tname">
    <input type="submit" name="doSearch" value="Search">
</form>
<?php
require_once '.secret.php';

$db = new mysqli('cis.gvsu.edu', // hostname of db server
    $mysqluser, // your userid
    $mysqlpassword, // your password
    $mydbname);

session_start();
printf('<h3>New Rental for Customer %s</h3>', $_SESSION['cName']);
printf('<table> <tr><th>Title</th><th>Rating</th><th>Duration</th><th>Actors</th><th>Available Inventory</th></tr>');

if (isset($_GET['doSearch']) && !empty($_GET['tname'])) {
    $titleName = urldecode($_GET['tname']);
    /*printf('<p>Title: %s</p>', $titleName);*/
    $custId = urlencode($_SESSION['cId']);
    $fTitle = urldecode($_GET['tname']);

    $rentalStr = <<<LAKER
    SELECT * FROM film 
    WHERE title LIKE '%$fTitle%'
LAKER;

    $i = 1;
    $result = $db->query($rentalStr);
    while ($row = $result->fetch_assoc()) {
        $fid = $row['film_id'];

        $filmStr = <<<LAKER
        SELECT * FROM inventory 
        WHERE inventory.film_id =$fid
LAKER;
        $inv = $db->query($filmStr);
        while($invRow = $inv->fetch_assoc()) {
            $invArray[] = $invRow['inventory_id'];
        }    
        
        $actStr = <<<LAKER
        SELECT * FROM film_actor 
        WHERE film_id =$fid
LAKER;

        print_r("Here 1");

        // Get all actor ids and put in actArray
        $act = $db->query($actStr);
        while($actRow = $act->fetch_assoc()) {
            $actArray[] = $actRow['actor_id'];
        }

        $actNameStr = <<<LAKER
        SELECT * FROM actor 
        WHERE actor_id =$fid
LAKER;
        print_r("Here 2");
        // For every actor id in the array, get their name string
        foreach($actArray as $akt){
            $actNameStr = <<<LAKER
            SELECT * FROM actor 
            WHERE actor_id =$akt
LAKER;
            $aktName = $db->query($actNameStr);
            $aktNameRow = $aktName->fetch_assoc();
            $aktName[] = $aktNameRow['first_name']." ".$aktNameRow['last_name'];
        }

        print_r("Here 3");
        
        // Print first three items
        printf('<tr><td>%s</td><td>%s</td><td>%s</td>',
        $row['title'], $row['rating'], $row['length']);

        print_r("Here");

        // Print Actor Names
        printf('<td>');
        foreach($aktName as $a){
            printf('%s ', $a);
        }
        printf('</td>');

        //For inventories
        printf('<td>');

        foreach($invArray as $i){
            printf('%s ', $i);
        }
        printf('</td></tr>');
        
    }
} else {
    printf('<tr><td colspan="6" align="center">Nothing to Display.</td></tr>');
}

printf('</table>');


?>
</body>
</html>