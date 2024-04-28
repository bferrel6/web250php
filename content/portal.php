<?php

if (isset($_POST["submitLogin"])) {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    require_once 'content/components/db.php';
    require_once 'content/components/loginFunctions.php';

    loginUser($mysqli, $username, $pwd);

} elseif (isset($_POST["submitRegister"])) {

    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdConfirm"];

    require_once 'content/components/db.php';
    require_once 'content/components/loginFunctions.php';

    /* vestigial errors from tutorial, handled by form */
    if (emptyInputSignup($firstName, $lastName, $email, $username, $pwd, $pwdRepeat) !== false) {
        echo "<h4>Error: all fields required, please try again</h4>";
        echo "<p><a href=\"?p=login\">Return to Login</a></p>";
        exit();
    }
    if (invalidEmail($email) !== false) {
        echo "<h4>Error: email not valid, please try again</h4>";
        echo "<p><a href=\"?p=login\">Return to Login</a></p>";
        exit();
    }
    /* actual errors needed */
    if (invalidUid($username) !== false) {
        echo "<h4>Error: username not valid, please try again</h4>";
        echo "<p><a href=\"?p=login\">Return to Login</a></p>";
        exit();
    }
    if (pwdMatch($pwd, $pwdRepeat) !== false) {
        echo "<h4>Error: passwords did not match, please try again</h4>";
        echo "<p><a href=\"?p=login\">Return to Login</a></p>";
        exit();
    }
    if (uidExists($mysqli, $username, $email) !== false) {
        echo "<h4>Error: username not available, please try again</h4>";
        echo "<p><a href=\"?p=login\">Return to Login</a></p>";
        exit();
    }
    createUser($mysqli, $firstName, $lastName, $email, $username, $pwd);
} elseif (isset($_SESSION["memberId"])) {
    echo "<h2>Member Portal</h2>";
    echo "<h4>Member #: " . $_SESSION["memberId"] . "</h4>";
    echo "<p>Name: " . $_SESSION["firstName"]
        . " " . $_SESSION["lastName"] . "<p>";
    echo "<p>Username: " . $_SESSION["username"] . "<p>";
    echo "<p>Email: " . $_SESSION["email"] . "<p>";
    echo "<p><a href=\"?p=components/logout\">Log Out</a></p>";
} else {
    header("location: ?p=login");
    exit();
}
