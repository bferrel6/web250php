<?php
include 'content/components/nav.php';
include 'content/components/db.php';
$id = $_GET['ID'];
$query = "SELECT * FROM modules WHERE ID='$id'";

// try to query the cars table
if ($result = $mysqli->query($query)) {
    //don't do anything if successful
} else {
    echo "Sorry, a module with an ID of $id cannot be found"
        . mysqli_error($mysqli) . "<br>";
}

// loop through all the rows returned by the query, creating a table row for each
while ($result_ar = mysqli_fetch_assoc($result)) {
    $type = $result_ar['TYPE'];
    $occupancy = number_format($result_ar['OCCUPANCY']);
    $deploy_date = $result_ar['DEPLOY_DATE'];
    $cost = number_format($result_ar['COST'], 2);
    $description = $result_ar['DESCRIPTION'];
}

echo "<div id='output'><h3>$type Module</h3>";
echo "<p>Occupancy: $occupancy</p>";
echo "<p>Deploy Date: $deploy_date</p>";
echo "<p>Cost: $$cost</p>";
echo "<p>Description: $description</p></div>";

$query = "SELECT * FROM images WHERE MODULE_ID = $id";

// try to query the images table
if ($result = $mysqli->query($query)) {
    //got some results
    //loop through all the rows returned by the query
    echo "<div>";
    while ($result_ar = mysqli_fetch_assoc($result)) {
        $image = $result_ar['IMAGE_FILE'];
        echo "<img src='images/$image' alt='$type'>";
    }
    echo "<p>modules visualized by <a href='https://deepai.org/machine-learning-model/text2img' target='_blank' >DEEPAI.ORG</a></p>";
    echo "</div>";
} else {
    echo "Sorry, images of a module with ID of $id cannot be found"
        . mysqli_error($mysqli) . "<br>";
}

$mysqli->close();
?>
<div id="output">
<h4>Upload a Photo</h4>
<form action="?p=modules/uploadFile&ID=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
    <label for="file">Filename:</label>
    <input type="file" name="file" id="file"></br>
    <input type="submit" name="submit" value="Upload">
</form>
</div>

<p><a href="?p=viewModules">Return to Fleet Modules</a></p>