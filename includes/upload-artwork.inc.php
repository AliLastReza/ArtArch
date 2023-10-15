<?php
session_start();
$userId = $_SESSION['userId'];

if (isset($_POST["submit"])) {
    $file = $_FILES["artworkImage"];
    $fileName = $file["name"];
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
    if (in_array($fileActualExt, $allowedExts)) {
        if ($fileError === 0) {
            if ($fileSize < 2000001) {
                $newFileName = "u-" . $userId . "_fn-" . $fileNameArray[0] . "_" . uniqid() . "." . $fileActualExt;
                $fileDestination = "../uploads/artworks/".$newFileName;
                move_uploaded_file($fileTmpName, $fileDestination);

                include_once 'dbh.inc.php';
                include_once 'functions.inc.php';
                $title = $_POST["title"];
                $description = $_POST["description"];
                $width = $_POST["width"];
                $height = $_POST["height"];
                $result = createArtwork($conn, $title, $description, $userId, $newFileName, $width, $height);
                // print_r($result);
                // exit();
                if ($result["isCreated"]) {
                    header("Location: ../my-pieces.php?error=none&uploaded=yes");
                } else {
                    echo "Some error occurred during creating artwork record!";
                }
                exit();
            } else {
                echo "File size should be less then 2 MB.";
            }
        } else {
            echo "There was an error while uploading the file.";
        }
    } else {
        echo "This file extension is not allowed.";
    }
} else {
    echo "The form hasn't been submitted!";
}

exit();
