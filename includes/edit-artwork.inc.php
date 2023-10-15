<?php
session_start();
$userId = $_SESSION['userId'];

if (!isset($_POST["submit"])) {
    echo "The form hasn't submitted!";
    exit();
}

$file = $_FILES["artworkImage"];
$fileName = $file["name"];

// If file changed, save the new one
include_once "constants.inc.php";
include_once "functions.inc.php";
$fileLocation = $ARTWORKS_DIR_RELATIVE_TO_INCLUDES_PATH . $fileName;
if (!file_exists($fileLocation)) {
    echo "if";
    $fileSize = $file["size"];
    $fileTmpName = $file["tmp_name"];
    $fileError = $file["error"];
    $fileType = $file["type"];
    // echo $fileSize;
    // exit();

    $fileNameArray = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileNameArray));
    $allowedExts = array("jpg", "jpeg", "png", "gif", ".svg", ".webp");
    // https://developer.mozilla.org/en-US/docs/Web/Media/Formats/Image_types
    if (!in_array($fileActualExt, $allowedExts)) {
        echo "This file extension is not allowed.";
        exit();
    }
    if ($fileError !== 0) {
        echo "There was an error while uploading the file.";
        exit();
    }
    if ($fileSize > 2000000) {
        echo "File size should be less then 2 MB.";
        exit();
    }
    $fileName = "u-" . $userId . "_fn-" . $fileNameArray[0] . "_" . uniqid() . "." . $fileActualExt;
    $fileDestination = "../uploads/artworks/" . $newFileName;
    move_uploaded_file($fileTmpName, $fileDestination);
}

include_once 'dbh.inc.php';
include_once 'functions.inc.php';
$artId = $_POST["artId"];
$title = $_POST["title"];
$description = $_POST["description"];
$width = $_POST["width"];
$height = $_POST["height"];
$result = updateArtwork($conn, $title, $description, $artId, $fileName, $width, $height);
// print_r($result);
// exit();

if ($result["isUpdated"]) {
    header("Location: ../my-pieces.php?error=none&updated=yes");
} else {
    echo "Some error occurred during updating an artwork record!";
}

exit();
