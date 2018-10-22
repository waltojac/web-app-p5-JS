<?php
require_once '.secret.php';

$db = new mysqli('cis.gvsu.edu', // hostname of db server
    $mysqluser, // your userid
    $mysqlpassword, // your password
    $mydbname);

session_start();


if (isset($_GET['doSearch']) && !empty($_GET['tname'])) {
    $titleName = urldecode($_GET['tname']);
    $custId = urldecode($_SESSION['cId']);
    $fTitle = urldecode($_GET['tname']);

    $rentalStr = <<<LAKER
    SELECT * FROM film 
    WHERE title LIKE '%$fTitle%'
LAKER;

    $i = 1;
    $flag = false;
    $result = $db->query($rentalStr);
    while ($row = $result->fetch_assoc()) {
        $fid = $row['film_id'];
        $flag = true;

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


        // Get all actor ids and put in actArray
        $act = $db->query($actStr);
        while($actRow = $act->fetch_assoc()) {
            $actArray[] = $actRow['actor_id'];
        }

        // For every actor id in the array, get their name string
        foreach($actArray as $akt){
            $actNameStr = <<<LAKER
            SELECT * FROM actor 
            WHERE actor_id =$akt
LAKER;
            $aktName = $db->query($actNameStr);
            if ($aktNameRow = $aktName->fetch_assoc()) {
                $str1 = $aktNameRow['first_name'];
                $str2 = $aktNameRow['last_name'];
                $aktNameArray[] = $str1 . ' ' . $str2;
            }
        }

        
        // Print first three items
        printf('<tr><td>%s</td><td>%s</td><td>%s</td>',
        $row['title'], $row['rating'], $row['length']);


        // Print Actor Names
        printf('<td><ul>');
        foreach($aktNameArray as $a){
            printf('<li>%s</li>', $a);
        }
        printf('</ul></td>');

        //For inventories
        printf('<td>');

        foreach($invArray as $i){
            printf('<a href="rent.php?inv=%s&title=%s">%s</a>  ', $i, $row['title'], $i);
        }
        printf('</td></tr>');

        unset($aktNameArray);
        unset($invArray);
        
    }
    if (!$flag){
        printf('<tr><td colspan="6" align="center">No Matching Titles.</td></tr>');
    }
} else {
    printf('<tr><td colspan="6" align="center">No Matching Titles.</td></tr>');
}

printf('</table>');


?>
</body>
</html>