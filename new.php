<?php
require_once '.secret.php';

$db = new mysqli('cis.gvsu.edu', // hostname of db server
    $mysqluser, // your userid
    $mysqlpassword, // your password
    $mydbname);

if (!empty($_GET['tname'])) {
    $titleName = urldecode($_GET['tname']);
    $fTitle = urldecode($_GET['tname']);

    $rentalStr = <<<LAKER
    SELECT * FROM film 
    WHERE title LIKE '%$fTitle%'
LAKER;

    $i = 1;
    $flag = false;
    $result = $db->query($rentalStr);
    $obNum = 0;
    $jData;
    $invArray;
    $aktNameArray;

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

        $jData->title = $row['title'];
        $jData->rating = $row['rating'];
        $jData->length = $row['length'];
        $jData->aktArr = json_encode($aktNameArray);
        $jData->invArr = json_encode($invArray);
        $data[$obNum] = $jData;
        $obNum++;


        unset($jData);
        unset($aktNameArray);
        unset($invArray);
        unset($actArray);
        
    }
} 

print json_encode($data);

?>
