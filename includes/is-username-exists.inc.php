<?php
$username = $_GET['username'];

include_once 'dbh.inc.php';
include_once 'functions.inc.php';

$isUsernameExistsResult = isUsernameExists($conn, $username);

echo json_encode(array('isUsernameExists' => $isUsernameExistsResult));
