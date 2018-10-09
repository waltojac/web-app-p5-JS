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
printf('<table> <tr><th></th><th>Title</th><th>Rating</th><th>Duration</th><th>Actors</th><th>Available Inventory</th></tr>');

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
        printf('<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>',
        $i++, $row['title'], $row['rating'], $row['length'], $row['length'], $row['length']
    );
    }
} else {
    printf('<tr><td colspan="6" align="center">Nothing to Display.</td></tr>');
}

printf('</table>');


?>
</body>
</html>