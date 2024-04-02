<?php
include 'content/components/nav.php';
include 'content/components/db.php';

$id = $_GET['ID'];

echo "<div id=\"output\">";

if ($_FILES["file"]["error"] > 0) {
    echo "Error: " . $_FILES["file"]["error"] . "<br>";
} else {
    echo "Upload: " . $_FILES["file"]["name"] . "<br>\n";
    echo "Type: " . $_FILES["file"]["type"] . "<br>\n";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB <br>\n";
    echo "ID: " . $id . "<br>";
    echo "Store temporarily as: " . $_FILES["file"]["tmp_name"] . "<br><br>\n";

    $currentFolder = getcwd();
    echo "This script is running in: " . $currentFolder . "<br>\n";
    $targetPath = getcwd() . "/images/";
    echo "The uploaded file will be stored in the folder: "
        . $targetPath . "<br>\n";

    $targetPath = $targetPath . basename($_FILES['file']['name']);
    $imageName = "images/" . basename($_FILES['file']['name']);
    echo "The full file name of the uploaded file is '" . $targetPath . "'<br>\n";
    echo "The relative name of the file for use in the IMG tag is "
        . $imageName . "<br><br>\n";

    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
        echo "The file " . basename($_FILES['file']['name']) . " has been uploaded<br>\n";


        // create a databse entry for this image
        if (mysqli_connect_errno()) {
            printf("Connect failed:%s\n", mysqli_connect_error());
            exit();
        }
        echo "Connected successfully to MySQL.<br>";

        $fileName = $_FILES["file"]["name"];
        $query = "INSERT INTO images (MODULE_ID, IMAGE_FILE) VALUES ('$id', '$fileName')";
        echo "Your INSERT query: " . $query . "<br>";
        echo "<a href='?p=modules/viewModule&ID=" . $id
            . "'>Return to module details to add another image</a></p>\n";

        // try to insert the new car into the database
        if ($result = $mysqli->query($query)) {
            echo "<p>You have successfully entered $targetPath into the database.</p>\n";
        } else {
            echo "Error entering $id into database: " . mysqli_error($mysqli) . "<br>";
        }
        $mysqli->close();

        echo "<img src='$imageName' height='250'><br>";
    } else {
        echo "There was an error uploading the file, please try again!";
    }
}

echo "</div>";

?>
