<?php
$username = $_GET['username'];

include_once 'dbh.inc.php';
include_once 'functions.inc.php';

$isUsernameExistsResult = isUsernameExists($conn, $username);

header("Content-Type: application/json; charset: utf-8");
if ($isUsernameExistsResult === "mysqli_stmt_prepare_failed") {
    http_response_code(503);
    $response["status"] = "failed";
    $response["status_code"] = 503;
    $response["errors"]["server"] = 503;
    exit();
}

$response["status"] = "success";
$response["status_code"] = 200;
$response["isUsernameExists"] = $isUsernameExistsResult;
echo json_encode($response);
