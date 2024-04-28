<?php

/* vestigial errors from tutorial */
function emptyInputSignup($firstName, $lastName, $email, $username, $pwd, $pwdRepeat)
{
    $result = null;
    if (
        empty($firstName)
        || empty($lastName)
        || empty($email)
        || empty($username)
        || empty($pwd)
        || empty($pwdRepeat)
    ) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email)
{
    $result = null;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

/* actual errors needed */
function invalidUid($username)
{
    $result = null;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $pwdRepeat)
{
    $result = null;
    if ($pwd !== $pwdRepeat) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function uidExists($mysqli, $username, $email)
{
    $sql = "SELECT * FROM members WHERE username = ? OR email = ?;";
    $stmt = mysqli_stmt_init($mysqli);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "<h4>Database error, please notify administrator</h4>";
        echo "<p><a href=\"?p=login\">Return to Login</a></p>";
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($mysqli, $firstName, $lastName, $email, $username, $pwd)
{
    $sql = "INSERT INTO members (FIRST_NAME, LAST_NAME, EMAIL, USERNAME, PWD) 
            VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($mysqli);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "<h4>Database error, please notify administrator</h4>";
        echo "<p><a href=\"?p=login\">Return to Login</a></p>";
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssss", $firstName, $lastName, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    echo "<h4>$firstName $lastName registered successfully!</h4>";
    echo "<p><a href=\"?p=login\">Return to Login</a></p>";
    exit();
}

function loginUser($mysqli, $username, $pwd)
{
    # user prompted to enter username or email on form, function will check both
    $uidExists = uidExists($mysqli, $username, $username);

    if ($uidExists === false) {
        echo "<h4>Error: user not found, please try again</h4>";
        echo "<p><a href=\"?p=login\">Return to Login</a></p>";
        exit();
    }

    $pwdHashed = $uidExists["PWD"];
    $checkPwd = password_verify($pwd, $pwdHashed);
    if ($checkPwd === false) {
        echo "<h4>Error: incorrect password, please try again</h4>";
        echo "<p><a href=\"?p=login\">Return to Login</a></p>";
        exit();
    } else if ($checkPwd === true) {
        $_SESSION["memberId"] = $uidExists["MEMBERS_ID"];
        $_SESSION["username"] = $uidExists["USERNAME"];
        $_SESSION["firstName"] = $uidExists["FIRST_NAME"];
        $_SESSION["lastName"] = $uidExists["LAST_NAME"];
        $_SESSION["email"] = $uidExists["EMAIL"];
        header("location: ?p=portal");
    }
}
