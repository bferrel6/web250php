<?php
include 'content/components/nav.php';

// capture the values posted to this php program from the text fields in the form
$id = $_REQUEST['id'];
$type = $_REQUEST['type'];
$occupancy = $_REQUEST['occupancy'];
$deploy_date = $_REQUEST['deploy_date'];
$cost = $_REQUEST['cost'];
$description = $_REQUEST['description'];

// build a SQL query using the values from above
$query = "UPDATE modules SET
    
    TYPE = '$type',
    OCCUPANCY = '$occupancy',
    DEPLOY_DATE = '$deploy_date',
    COST = $cost,
    DESCRIPTION = '$description'

    WHERE ID = $id";

// print the query to the browser so you can see it
echo "Your UPDATE query: " . $query . "<br>";

include 'content/components/db.php';

// try to update the database record
if ($result = $mysqli->query($query)) {
    echo "<p>You have successfully updated <em> Module $type </em> in the database. </p>";
} else {
    echo "Error entering module $id into database: " . mysqli_error($mysqli) . "<br>";
}
$mysqli->close();
?>
<p><a href="?p=viewModules">Return to Fleet Modules</a></p>