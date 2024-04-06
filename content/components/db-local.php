<?php
    $mysqli = new mysqli('localhost', 'bf_admin', '3bfY_jviTz7-[4oY', 'blue_fortitude');
            
    //check connection
    if (mysqli_connect_errno()) {
        printf("Connection failed: %s\n", mysqli_connect_error());
        exit();
    }

    echo '<p>Connected successfully to MySQL.</p>';

    //select database to work with
    $mysqli->select_db('blue_fortitude');
    echo '<p>Selected the <em>Blue Fortitude</em> database.</p>';
?>