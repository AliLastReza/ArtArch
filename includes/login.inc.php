<?php

if (!isset($_POST["submit"])) {
    header("Location ../login.php");
    exit();
} else {
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];

    require_once "dbh.inc.php";
    require_once "functions.inc.php";

    if (emptyInputLogin($username, $pwd) !== false) {
        header("location: ../login.php?error=emptyinputs");
        exit();
    }

    loginUser($conn, $username, $pwd, "/ArtArc/my-pieces.php");
}