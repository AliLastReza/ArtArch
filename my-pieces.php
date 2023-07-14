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
                    <h1 class="h2 fw-normal">Pieces <small class="text-secondary h4">(18)</small></h1>
                </div>
                <div class="col-auto">
                    <form class="w-100 mt-2" role="search">
                        <input type="search" class="form-control search border-3 border-top-0 border-start-0 border-end-0 border-secondary-subtle rounded-0 text-secondary" placeholder="Piece Search" aria-label="Search">
                    </form>
                </div>
                <div class="col-auto mt-3 ps-0">
                    <a href="#" class="piece-search-submit"><i class="bi bi-search text-secondary" style="font-size: 18px;"></i></a>
                </div>
                <div class="col-auto ms-auto me-0 mt-3 text-body-secondary">
                    <b>Sort: </b>
                </div>
                <div class="col-auto ms-0 me-0 mt-3 ps-0">
                    <select name="sortBy" id="sortBySelect" class="form-select form-select-sm text-secondary fw-semibold border-0" style="font-size:12px;" aria-label="Sort by">
                        <option value="createdAtDESC">Created at (Desc)</option>
                        <option value="createdAtASC">Created at (Asc)</option>
                    </select>
                </div>
            </div>


            <div class="row mx-auto mt-4" data-masonry="{&quot;percentPosition&quot;: true }" style="width: 100%; height: 4500px;">
                <div class="col-sm-4 col-lg-3 mb-4" style="position: absolute; left: 0%; top: 361.6px;">
                    <div class="card artwork border-0">
                        <img src="https://d1zdxptf8tk3f9.cloudfront.net/artist_21441/info/large/Artist_Michelle_Locklear.jpg?1613600122" class="card-img-top rounded-0" alt="">
                        <div class="card-body p-1">
                            <p class="text-center mb-0 fw-semibold text-body-secondary">5 Tomatoes</p>
                            <small class="d-block text-center fw-semibold text-body-secondary" style="font-size: 12px;">
                                2012, Oil
                            </small>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-lg-3 mb-4" style="position: absolute; left: 0%; top: 361.6px;">
                    <div class="card artwork border-0">
                        <img src="https://assets.artworkarchive.com/image/upload/t_square_crop_small/v1/user_673/Unstoppable_Passion_000720-1__48x48_cnd6hf" class="card-img-top rounded-0" alt="">
                        <div class="card-body p-1">
                            <p class="text-center mb-0 fw-semibold text-body-secondary">5 Tomatoes</p>
                            <small class="d-block text-center fw-semibold text-body-secondary" style="font-size: 12px;">
                                2012, Oil
                            </small>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-lg-3 mb-4" style="position: absolute; left: 0%; top: 361.6px;">
                    <div class="card artwork border-0">
                        <img src="https://d1zdxptf8tk3f9.cloudfront.net/artist_21441/info/large/Artist_Michelle_Locklear.jpg?1613600122" class="card-img-top rounded-0" alt="">
                        <div class="card-body p-1">
                            <p class="text-center mb-0 fw-semibold text-body-secondary">5 Tomatoes</p>
                            <small class="d-block text-center fw-semibold text-body-secondary" style="font-size: 12px;">
                                2012, Oil
                            </small>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-lg-3 mb-4" style="position: absolute; left: 0%; top: 361.6px;">
                    <div class="card artwork border-0">
                        <img src="https://assets.artworkarchive.com/image/upload/t_square_crop_small/v1/user_673/Unstoppable_Passion_000720-1__48x48_cnd6hf" class="card-img-top rounded-0" alt="">
                        <div class="card-body p-1">
                            <p class="text-center mb-0 fw-semibold text-body-secondary">5 Tomatoes</p>
                            <small class="d-block text-center fw-semibold text-body-secondary" style="font-size: 12px;">
                                2012, Oil
                            </small>
                        </div>
                    </div>
                </div>


                <div class="col-sm-4 col-lg-3 mb-4" style="position: absolute; left: 0%; top: 361.6px;">
                    <div class="card artwork border-0">
                        <img src="https://d1zdxptf8tk3f9.cloudfront.net/artist_21441/info/large/Artist_Michelle_Locklear.jpg?1613600122" class="card-img-top rounded-0" alt="">
                        <div class="card-body p-1">
                            <p class="text-center mb-0 fw-semibold text-body-secondary">5 Tomatoes</p>
                            <small class="d-block text-center fw-semibold text-body-secondary" style="font-size: 12px;">
                                2012, Oil
                            </small>
                        </div>
                    </div>
                </div>

                <nav aria-label="...">
                    <ul class="pagination justify-content-center mt-5">
                        <li class="page-item disabled">
                            <a class="page-link" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active" aria-current="page">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</main>

<?php
include_once 'dash-footer.php';
?>