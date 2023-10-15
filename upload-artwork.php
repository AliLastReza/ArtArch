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
                    <h1 class="h2 fw-normal">Upload A New Artwork</h1>
                </div>
            </div>
            <form action="includes/upload-artwork.inc.php" method="POST" enctype="multipart/form-data">
                <div class="row mt-4">
                    <div class="col-9">
                        <div class="container">
                            <div class="mb-3">
                                <label for="artworkInput" class="form-label">Select Your Artwork's File</label>
                                <input name="artworkImage" class="form-control w-50" type="file" id="artworkInput">
                            </div>
                            <div class="artwork border border-secondary-subtle p-4">
                                <img src="uploads/artworks/Artwork-Placeholder.png" id="artworkImage" height="500px" style="max-width: 100%" class="border border-secondary mx-auto d-block" alt="Artwork">
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="container mt-5 pt-5">
                            <div class="mb-3">
                                <label for="titleInput" class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" id="titleInput" placeholder="Your Piece's Title">
                            </div>
                            <div class="mb-3">
                                <label for="DescriptionInput" class="form-label">Description</label>
                                <input type="text" name="description" class="form-control" id="DescriptionInput" placeholder="How do you want to describe it?">
                            </div>
                            <div class="mb-3">
                                <label for="WidthInput" class="form-label">Width</label>
                                <input type="number" name="width" class="form-control" id="WidthInput" placeholder="Width">
                            </div>
                            <div class="mb-3">
                                <label for="HeightInput" class="form-label">Height</label>
                                <input type="number" name="height" class="form-control" id="HeightInput" placeholder="Height">
                            </div>
                            <button class="btn btn-primary" name="submit" value="submit" type="submit">Upload</button>
                        </div>
                    </div>
                </div>
            </form>
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
    // .onchange = function() {
    //     var src = URL.createObjectURL(this.files[0]);
    //     document.getElementById('ArtworkImage').src = src;
    // }
</script>

<?php
include_once 'dash-footer.php';
?>