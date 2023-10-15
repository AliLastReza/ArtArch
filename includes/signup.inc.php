<?php

if (!isset($_POST['submit'])) {
    header("Location: ../sign-up.php");
    exit();
}

$name = $_POST['name'];
$email = $_POST['email'];
$username = $_POST['username'];
$pwd = $_POST['pwd'];
$pwdRepeat = $_POST['pwdRepeat'];

include_once 'dbh.inc.php';
include_once 'functions.inc.php';

$errors = array();

if (empty($name)) {
    $errors["name"][] = "empty";
}
if (empty($email)) {
    $errors["email"][] = "empty";
}
if (empty($username)) {
    $errors["username"][] = "empty";
}
if (empty($pwd)) {
    $errors["pwd"][] = "empty";
}
if (empty($pwdRepeat)) {
    $errors["pwdRepeat"][] = "empty";
}

if (!isValidUsername($username)) {
    $errors["username"][] = "not_valid";
}
if (!isValidEmail($email)) {
    $errors["email"][] = "not_valid";
}
if (!doPasswordsMatch($pwd, $pwdRepeat)) {
    $errors["pwdRepeat"][] = "not_match";
}
if (isUsernameExists($conn, $username)) {
    $errors["username"][] = "exists";
}

header('Content-Type: application/json; charset=utf-8');

if (count($errors)) {
    $response["status"] = "failed";
    $response["status_code"] = 400;
    $response["errors"]["fields"] = $errors;
    http_response_code(400);
    echo json_encode($response);
    exit();
}

$result = createUser($conn, $name, $email, $username, $pwd);

if ($result["isCreated"]) {
    $response["status"] = "success";
    $response["status_code"] = 200;
    header("/ArtArc/");
    include_once("functions.inc.php");
    loginUser($conn, $username, $pwd, "/ArtArc/sign-up.php");
} else {
    $response["status"] = "failed";
    $response["status_code"] = 503;
    http_response_code(503);
    $response["errors"]["server"] = 503;
}

echo json_encode($response);
