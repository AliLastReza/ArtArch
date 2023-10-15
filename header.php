<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ArtArc -> A Place for Art & Artists</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/artist.css" rel="stylesheet">
    <script src="assets/js/jquery-3.7.0.min.js"></script>

    <style>
        input:required + label::after { content: " *"; }
    </style>
</head>

<body>
    <header class="p-1 border-bottom bg-gray-aa">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/ArtArc/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none me-4">
                    <div class="h2 mb-0 fw-semibold text-white">AA</div>
                </a>

                <ul class="nav col-12 col-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="/ArtArc/" class="nav-link nav-link-aa px-2 text-white" style="--bs-text-opacity: .7;">Artists</a></li>
                </ul>

                <form class="col-12 col-lg-6 mb-3 mb-lg-0 ms-lg-4 me-lg-auto" role="search">
                    <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search For Artists..." aria-label="Search">
                </form>

                <?php
                if (isset($_SESSION["userId"])) {
                    echo '
                    <div class="dropdown text-end">
                        <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://github.com/mdo.png" alt="mdo" class="rounded-circle" width="32" height="32">
                        </a>
                        <ul class="dropdown-menu text-small" style="">
                            <li><a class="dropdown-item" href="upload-artwork.php">Upload A New Piece</a></li>
                            <li><a class="dropdown-item" href="my-pieces.php">My Pieces</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="includes/logout.inc.php">Log out</a></li>
                        </ul>
                    </div>';
                } else {
                    echo '
                    <div class="nav col-12 col-lg-auto">
                        <a href="/ArtArc/login.php" class="nav-link nav-link-aa px-2 text-white" style="--bs-text-opacity: .7;">Log In</a>
                        <a href="/ArtArc/sign-up.php" class="nav-link nav-link-aa px-2 text-white" style="--bs-text-opacity: .7;">Sign Up</a>
                    </div>';
                }
                ?>
            </div>
        </div>
    </header>