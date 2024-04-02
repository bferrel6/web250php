<?php
include 'content/components/nav.php';
include 'content/components/db.php';

$id = $_GET['ID'];
$query = "SELECT * FROM modules WHERE ID = '$id'";

//try to query the database
if ($result = $mysqli->query($query)) {
    //don't do anything if successful
} else {
    echo "Sorry, a module with ID of $id cannot be found " . $mysqli->error . "<br>";
}

//loop through all the rows returned by the query, creating a table row for each
while ($result_ar = mysqli_fetch_assoc($result)) {
    $id = $result_ar['ID'];
    $type= $result_ar['TYPE'];
    $occupancy = $result_ar['OCCUPANCY'];
    $deploy_date = $result_ar['DEPLOY_DATE'];
    $cost = $result_ar['COST'];
    $description = $result_ar['DESCRIPTION'];
}

$mysqli->close();
?>
<div id="output">
<h3>Edit Module Details</h3>
<form action="?p=modules/updateRecord" method="post">
    <label for="id">ID:</label>
    <input name="id" type="text" value="<?php echo $id; ?>" required><br>
    <label for="type">Type:</label>
    <input name="type" type="text" value="<?php echo $type; ?>" required><br>
    <label for="occupancy">Occupancy:</label>
    <input name="occupancy" type="text" value="<?php echo $occupancy; ?>"><br>
    <label for="deploy_date">Deploy Date:</label>
    <input name="deploy_date" type="date" value="<?php echo $deploy_date; ?>"><br>
    <label for="cost">Cost:</label>
    <input name="cost" type="text" pattern="^\d*(\.\d{0,2})?$" value="<?php echo $cost; ?>"><br>
    <label for="description">Description:</label>
    <textarea name="description"><?php echo $description; ?></textarea><br>
    <input name="submit1" type="submit" value="Submit Changes"><br>
</form>
</div>