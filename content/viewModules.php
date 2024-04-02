<?php
include 'content/components/nav.php';
include 'content/components/db.php';

echo "<h2>Fleet Command Interface</h2>";

$query = "SELECT * FROM modules";

//try to query the database
if ($result = $mysqli->query($query)) {
    // don't do anything if successful
} else {
    echo "Error getting modules from the database: " . $mysqli_error($mysqli) . "<br>";
}

//create the table headers
echo "<table id='grid'><tr>";
echo "<th> Module Type </th>";
echo "<th> Deployment Date </th>";
echo "<th> Cost </th>";
echo "<th> Operations </th>";
echo "</td></tr>\n";

//keep track of whether a row was even or odd, so we can style it later
$class = "odd";

//loop through all the rows returned by the query, creating a table row for each
while ($result_ar = mysqli_fetch_assoc($result)) {
    echo "<tr class='$class'>";
    echo "<td><a href='?p=modules/viewModule&ID=" . $result_ar['ID'] . "'>"
        . $result_ar['TYPE'] . "</a></td>";
    echo '<td>' . $result_ar['DEPLOY_DATE'] . "</td>";
    echo '<td>$' . number_format($result_ar['COST'], 2) . "</td>";
    echo "<td><a href='?p=modules/editModule&ID=" . $result_ar['ID'] . "'><em>Edit</em></a> | ";
    echo "<a onclick='return confirm(\"Are you sure?\")' href='?p=modules/deleteRecord&ID="
        . $result_ar['ID'] . "'><em>Delete</em></a></td>";
    echo '</tr>';

    //if the last row was even, make the next one odd, and vice versa
    if ($class == "odd") {
        $class = "even";
    } else {
        $class = "odd";
    }
}

echo "</table>";
$mysqli->close();

echo "<p>Based on <a 
href=\"https://kupdf.net/download/the-joy-of-php-alan-forbes_58ebadaddc0d60cb15da9816_pdf#\"
><em>The Joy of PHP</em></p>";
?>