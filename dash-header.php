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
    <link href="assets/css/bootstrap-icons.min.css" rel="stylesheet">

    <style>

    </style>
</head>

<body>
    <header class="p-1 border-bottom text-bg-light">
        <div class="container-fluid">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start bg-tertiary">
                <a href="/ArtArc/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none me-4">
                    <div class="h2 mb-0 fw-semibold">AA</div>
                    <div class="h4 mb-0 ms-lg-2 fw-light">Art Arc</div>
                </a>

                <form class="col-12 col-lg-3 mb-3 mb-lg-0 me-lg-4 ms-lg-auto" role="search">
                    <input type="search" class="form-control" placeholder="Piece Search" aria-label="Search">
                </form>

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
                </div>
            </div>
        </div>
    </header>