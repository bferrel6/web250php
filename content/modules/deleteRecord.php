<?php
include 'content/components/nav.php';
include 'content/components/db.php';

$id = $_GET['ID'];
$query = "DELETE FROM modules WHERE ID = $id";
echo "Your DELETE query: " . $query . "<br>";

// try to execute the DELETE against the database
if ($result = $mysqli->query($query)) {
    echo "The module with ID $id has been deleted <br>";
} else {
    echo "Sorry, a module with ID of $id cannot be found: " . mysqli_error($mysqli) . "<br>";
}

$mysqli->close();
?>

<p><a href="?p=viewModules">Return to Fleet Modules</a></p>