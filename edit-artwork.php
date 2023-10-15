<?php
include_once 'dash-header.php';
?>

<main class="container-fluid">
    <div class="row">
        <div class="col-2 py-4 bg-light border-end border-light-subtle">
            <div class="left-nav">
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-auto ps-2 pe-0">
                            <i class="bi bi-images" style="color: #068db5; font-size: 18px;"></i>
                        </div>
                        <div class="col-auto ps-2">
                            <b>
                                Pieces
                            </b>
                        </div>
                        <div class="col-auto ms-auto me-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right fw-bolder" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </div>
                    </div>
                    <hr>
                    <div class="row my-4">
                        <div class="col-auto ps-2 pe-0">
                            <i class="bi bi-globe-asia-australia" style="font-size: 16px;"></i>
                        </div>
                        <div class="col-auto ps-2">
                            My Profile
                            <br>
                            <em><small class="text-primary fw-semibold">Public</small></em>
                        </div>
                    </div>
                    <hr>
                    <div class="row my-4 text-secondary fw-semibold">
                        <div>Discovery</div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-10 py-4">
            <div class="row">
                <div class="col-auto ms-3">
                    <h1 class="h2 fw-normal">Edit An Artwork</h1>
                </div>
            </div>
            <form action="includes/edit-artwork.inc.php" method="POST" enctype="multipart/form-data">
                <div class="row mt-4">
                    <div class="col-9">
                        <div class="container">
                            <div class="mb-3">
                                <label for="artworkInput" class="form-label">Select the new file or leave it unchange</label>
                                <input name="artworkImage" class="form-control w-50" type="file" id="artworkInput">
                            </div>
                            <div class="artwork border border-secondary-subtle p-4">
                                <script>
                                    function loadURLToInputFiled(url, fileName) {
                                        getImgURL(url, (imgBlob) => {
                                            // Load img blob to input
                                            // WIP: UTF8 character error
                                            let file = new File([imgBlob], fileName, {
                                                type: "image/jpeg",
                                                lastModified: new Date().getTime()
                                            }, 'utf-8');
                                            let container = new DataTransfer();
                                            container.items.add(file);
                                            document.querySelector('#artworkInput').files = container.files;

                                        })
                                    }
                                    // xmlHTTP return blob respond
                                    function getImgURL(url, callback) {
                                        var xhr = new XMLHttpRequest();
                                        xhr.onload = function() {
                                            callback(xhr.response);
                                        };
                                        xhr.open('GET', url);
                                        xhr.responseType = 'blob';
                                        xhr.send();
                                    }
                                </script>
                                <?php
                                include_once "includes/dbh.inc.php";
                                include_once "includes/functions.inc.php";
                                include_once "includes/constants.inc.php";

                                $artId = $_GET["artId"];
                                echo '
                                <input type="hidden" name="artId" value="' . $artId . '" />';
                                $art = getAnArtwork($conn, $artId);
                                $artImgURL = getSiteURL() . $ARTWORKS_DIR . $art['filename'];
                                echo '
                                <script>
                                loadURLToInputFiled("' . $artImgURL . '", "' . $art['filename'] . '");
                                </script>';

                                echo '
                                <img src="' . $artImgURL . '" id="artworkImage" height="500px" style="max-width: 100%" class="border border-secondary mx-auto d-block" alt="Artwork">
                                ';
                                ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="container mt-5 pt-5">
                            <?php

                            echo '
                            <div class="mb-3">
                                <label for="titleInput" class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" id="titleInput" placeholder="Your Piece\'s Title"
                                value="' . $art['title'] . '">
                            </div>';

                            echo '
                            <div class="mb-3">
                                <label for="DescriptionInput" class="form-label">Description</label>
                                <input type="text" name="description" class="form-control" id="DescriptionInput" placeholder="How do you want to describe it?"
                                value="' . $art['description'] . '">
                            </div>';

                            echo '
                            <div class="mb-3">
                                <label for="WidthInput" class="form-label">Width</label>
                                <input type="number" name="width" class="form-control" id="WidthInput" placeholder="Width"
                                value="' . $art['width'] . '">
                            </div>';

                            echo '
                            <div class="mb-3">
                                <label for="HeightInput" class="form-label">Height</label>
                                <input type="number" name="height" class="form-control" id="HeightInput" placeholder="Height"
                                value="' . $art['height'] . '">
                            </div>';
                            ?>

                            <button class="btn btn-primary" name="submit" value="submit" type="submit">Upload</button>
                            <button class="btn btn-danger float-end" name="delete" value="delete" type="button"
                            data-bs-toggle="modal" data-bs-target="#exampleModal">>Delete</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    const imgInput = document.getElementById('artworkInput');
    const imgElement = document.getElementById('artworkImage');
    imgInput.onchange = evt => {
        const [file] = imgInput.files;
        if (file) {
            imgElement.src = URL.createObjectURL(file);
        }
    }
</script>

<?php
include_once 'dash-footer.php';
?>