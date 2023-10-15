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
    $sql = "SELECT * FROM users WHERE username = ? OR email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $result["error"] = "stmtfailed";
        return $result;
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
    }

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

function isEmailExists($conn, $email)
{
    $sql = "SELECT 1 FROM users WHERE email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        return 'mysqli_stmt_prepare_failed';
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
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

function createUser($conn, $name, $email, $username, $pwd)
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

function createArtwork($conn, $title, $description, $userId, $fileName, $width, $height)
{
    $query = "INSERT INTO artworks (title, description, userId, filename, width, height)
                          values (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $query)) {
        $result["isCreated"] = false;
        $result["reason"] = "stmt_prepare_failed";
        return $result;
    } else {
        mysqli_stmt_bind_param($stmt, "ssssss", $title, $description, $userId, $fileName, $width, $height);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        $result["isCreated"] = true;
        // $result["error"] = mysqli_error($conn);
        return $result;
    }
}

function updateArtwork($conn, $title, $description, $artId, $fileName, $width, $height)
{
    $query = "UPDATE artworks
                 SET
                     title = ?,
                     description = ?,
                     filename = ?,
                     width = ?,
                     height = ?,
                     updatedAt = CURRENT_TIMESTAMP
                 WHERE id = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $query)) {
        $result["isUpdated"] = false;
        $result["reason"] = "stmt_prepare_failed";
        return $result;
    } else {
        mysqli_stmt_bind_param($stmt, "ssssss", $title, $description, $fileName, $width, $height, $artId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        $result["isUpdated"] = true;
        // $result["error"] = mysqli_error($conn);
        return $result;
    }
}

function getAnArtwork($conn, $artId)
{
    $query = "SELECT * FROM artworks WHERE id = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $query)) {
        $result["isCreated"] = false;
        $result["reason"] = "stmt_prepare_failed";
        return $result;
    } else {
        mysqli_stmt_bind_param($stmt, "s", $artId);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);

        if ($row = mysqli_fetch_assoc($resultData)) {
            $result = $row;
        } else {
            $result = false;
        }
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

function loginUser($conn, $username, $pwd, $redirectTo)
{
    $uidExists = uidExists($conn, $username, $username);

    if ($uidExists === false) {
        header("Location: ../login.php?error=wronglogin");
        exit();
    } else if (isset($uidExists["error"])) {
        if ($uidExists["error"] == "stmtfailed") {
            header("location: " . $redirectTo . "?error=stmtfailed");
            exit();
        }
    }

    $pwdHashed = $uidExists["password"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("Location: ../login.php?error=wronglogin");
        exit();
    } else if ($checkPwd === true) {
        session_start();
        $_SESSION["userId"] = $uidExists["id"];
        $_SESSION["username"] = $uidExists["username"];
        $_SESSION["userEmail"] = $uidExists["email"];
        header("Location: ../index.php");
        exit();
    }
}

function getUserArtworkCount($conn, $userId) {
    $query = "SELECT count(id) FROM artworks WHERE userId = $userId;";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);
    return $row[0];
}

function getUserArtworks($conn, $userId, $limit, $offset) {
    $query = "SELECT * FROM artworks WHERE userId = $userId LIMIT $limit OFFSET $offset;";
    $result = mysqli_query($conn, $query);
    $resultArray = array();
    while($row = mysqli_fetch_assoc($result)) {
        $resultArray[] = $row;
    }
    return $resultArray;
}

function addAParamToQueryString($aUrl, $param, $value) {

    $url_parts = parse_url($aUrl);
    // If URL doesn't have a query string.
    if (isset($url_parts['query'])) { // Avoid 'Undefined index: query'
        parse_str($url_parts['query'], $params);
    } else {
        $params = array();
    }

    $params[$param] = $value;

    // Note that this will url_encode all values
    $url_parts['query'] = http_build_query($params);

    echo $url_parts['scheme'] . '://' . $url_parts['host'] . $url_parts['path'] . '?' . $url_parts['query'];
}

function getSiteURL() {
    return (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]";
}
