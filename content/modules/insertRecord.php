<?php
include 'content/components/nav.php';

//Capture the values posted to this php program from the text fields in the form

$type = $_POST['type'];
$occupancy = $_POST['occupancy'];
$deploy_date = $_POST['deploy_date'];
$cost = $_POST['cost'];
$description = $_POST['description'];

//Build a SQL query using the values from above

$query = "INSERT INTO modules (TYPE, OCCUPANCY, DEPLOY_DATE, COST, DESCRIPTION) VALUES (
        '$type',
        '$occupancy',
        '$deploy_date',
        '$cost',
        '$description'
    )";

//Print the query to the browser so you can see it
echo "<div id='output'>Your INSERT query: " . $query . "<br>";

//access mysql and select cars database
include 'content/components/db.php';

//try to insert the new car into the database
if ($result = $mysqli->query($query)) {
    echo "You have successfully entered module <em>$type</em> into the database.</div>";
} else {
    echo "Error entering module into database" . $mysqli_error($mysqli) . ".</div>";
}

$mysqli->close();
?>
<p><a href="?p=viewModules">Return to Fleet Modules</a></p>