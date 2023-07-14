<?php

function areAllSignUpInputsFilled($name, $email, $username, $pwd, $pwdRepeat)
{
    $result = false;
    if (!empty($name) && !empty($email) && !empty($username) && !empty($pwd) && !empty($pwdRepeat)) {
        $result = true;
    }
    return $result;
}

function isValidUsername($username)
{
    $result = false;
    if (preg_match("/^[a-zA-Z0-9]+$/", $username)) {
        $result = true;
    }
    return $result;
}

function isValidEmail($email)
{
    $result = false;
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    return $result;
}

function doPasswordsMatch($pwd, $pwdRepeat)
{
    $result = false;
    if ($pwd === $pwdRepeat) {
        $result = true;
    }
    return $result;
}

function uidExists($conn, $username, $email)
{
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../sign-up.php?error=stmtfailed");
        exit();
    } else {
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
}

function isUsernameExists($conn, $username)
{
    $sql = "SELECT 1 FROM users WHERE username = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        return 'mysqli_stmt_prepare_failed';
    } else {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($resultData)) {
            $result = true;
        } else {
            $result = false;
        }
        mysqli_stmt_close($stmt);
        return $result;
    }
}

function create_user($conn, $name, $email, $username, $pwd)
{
    $sql = "INSERT INTO users (name, username, email, password) values (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $result["isCreated"] = false;
        $result["reason"] = "stmt_prepare_failed";
        return $result;
    } else {
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $name, $username, $email, $hashedPwd);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        $result["isCreated"] = true;
        return $result;
    }
}

function emptyInputLogin($username, $pwd)
{
    $result;
    if (empty($username) || empty($pwd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function loginUser($conn, $username, $pwd) {
    $uidExists = uidExists($conn, $username, $username);

    if ($uidExists === false) {
        header("Location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("Location: ../login.php?error=wronglogin");
        exit();
    } else if ($checkPwd === true) {
        session_start();
        $_SESSION["userid"] = $uidExists["usersId"];
        $_SESSION["useruid"] = $uidExists["usersUid"];
        header("Location: ../index.php");
        exit();
    }
}