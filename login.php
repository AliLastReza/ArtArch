<?php
include 'header.php';
?>

<div class="modal modal-sheet position-static d-block bg-body-secondary p-4 py-md-5" tabindex="-1" role="dialog" id="modalSignin">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <h1 class="fw-bold mb-0 fs-2">Sign up for free</h1>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>

            <div class="modal-body p-5 pt-0">
                <form action="includes/login.inc.php" method="post" data-bitwarden-watching="1">
                    <div class="form-floating mb-3">
                        <input type="text" name="uid" class="form-control rounded-3" id="usernameInput" placeholder="Username">
                        <label for="usernameInput">Username/Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="pwd" class="form-control rounded-3" id="pwdInput" placeholder="Password">
                        <label for="pwdInput">Password</label>
                    </div>
                    <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit" name="submit">Login</button>
                </form>
                <?php
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "emptyinputs") {
                        echo "<p class='text-center mt-2 text-danger'>Fill in all fields.</p>";
                    }
                    if ($_GET["error"] == "wronglogin") {
                        echo "<p class='text-center mt-2 text-danger'>Invalid username/email or password.</p>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>