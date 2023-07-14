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
                <form action="includes/signup.inc.php" method="post" id="signUpForm" data-bitwarden-watching="1">
                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control rounded-3" id="nameInput" placeholder="Name">
                        <label for="nameInput">Name</label>
                        <div class="invalid-feedback" id>
                            This field is required.
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="email" class="form-control rounded-3" id="emailInput" placeholder="Email Address">
                        <label for="emailInput">Email Address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="username" class="form-control rounded-3" id="usernameInput" placeholder="Username">
                        <label for="usernameInput">Username</label>
                        <div class="invalid-feedback">
                            Someone already has that username. Try another?
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="pwd" class="form-control rounded-3" id="pwdInput" placeholder="Password">
                        <label for="pwdInput">Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="pwdRepeat" class="form-control rounded-3" id="pwdRepeat" placeholder="Repeat Password">
                        <label for="pwdRepeat">Repeat Password</label>
                    </div>
                    <input type="hidden" name="submit" value="sign-up">
                    <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit" name="submit">Sign up</button>
                    <small class="text-body-secondary">By clicking Sign up, you agree to the terms of use.</small>
                </form>
                <script>
                    $(document).ready(function() {
                        var isUsernameExistsReq = null;
                        var usernameMinLength = 3;

                        $("#usernameInput").keyup(function() {
                            $("#usernameInput").removeClass("is-invalid")
                            $("#usernameInput").removeClass("is-valid")
                            var that = this,
                                value = $(this).val();

                            if (value.length >= usernameMinLength) {
                                if (isUsernameExistsReq != null)
                                    isUsernameExistsReq.abort();
                                isUsernameExistsReq = $.ajax({
                                    type: "GET",
                                    url: "includes/is-username-exists.inc.php",
                                    data: {
                                        'username': value
                                    },
                                    dataType: "text",
                                    success: function(data) {
                                        //we need to check if the value is the same
                                        if (value == $(that).val()) {
                                            if (data["isUsernameExists"]) {
                                                $("#usernameInput").addClass("is-invalid")
                                            } else {
                                                $("#usernameInput").addClass("is-valid")
                                            }
                                        }
                                    }
                                });
                            }
                        });

                        var isEmailExistsReq = null;

                        $("#emailInput").blur(function() {
                            $("#emailInput").removeClass("is-invalid")
                            $("#emailInput").removeClass("is-valid")
                            var that = this,
                                value = $(this).val();

                            if (isEmailExistsReq != null)
                                isEmailExistsReq.abort();
                            isEmailExistsReq = $.ajax({
                                type: "GET",
                                url: "includes/is-email-exists.inc.php",
                                data: {
                                    'email': value
                                },
                                dataType: "text",
                                success: function(data) {
                                    //we need to check if the value is the same
                                    if (value == $(that).val()) {
                                        if (data["isEmailExists"]) {
                                            $("#emailInput").addClass("is-invalid")
                                        } else {
                                            $("#emailInput").addClass("is-valid")
                                        }
                                    }
                                }
                            });
                        });

                        var signUpReq;

                        // Bind to the submit event of our form
                        $("#signUpForm").submit(function(event) {
                            event.preventDefault();

                            if (signUpReq) {
                                signUpReq.abort();
                            }

                            var $form = $(this);
                            var $inputs = $form.find("input, select, button, textarea");
                            console.log($inputs);
                            var serializedData = $form.serialize();

                            // Let's disable the inputs for the duration of the Ajax request.
                            // Note: we disable elements AFTER the form data has been serialized.
                            // Disabled form elements will not be serialized.
                            $inputs.prop("disabled", true);

                            // Fire off the request to /form.php
                            signUpReq = $.ajax({
                                url: "includes/signup.inc.php",
                                type: "post",
                                data: serializedData
                            });

                            signUpReq.done(function(response, textStatus, jqXHR) {
                                console.log("Hooray, it worked!");
                                console.log(response);
                            });

                            signUpReq.fail(function(jqXHR, textStatus, errorThrown) {
                                console.error(
                                    "The following error occurred: " +
                                    textStatus, errorThrown
                                );
                                console.log(textStatus);
                                console.log(errorThrown);
                                console.log(JSON.parse(jqXHR.responseText));
                            });

                            signUpReq.always(function() {
                                // Reenable the inputs
                                $inputs.prop("disabled", false);
                            });

                        });
                    });
                </script>
                <?php
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "emptyinputs") {
                        echo "<p class='text-center mt-2 text-danger'>Fill in all fields.</p>";
                    }
                    if ($_GET["error"] == "invalid-username") {
                        echo "<p class='text-center mt-2 text-danger'>Enter a proper username.</p>";
                    }
                    if ($_GET["error"] == "invalidemail") {
                        echo "<p class='text-center mt-2 text-danger'>Enter a proper email address.</p>";
                    }
                    if ($_GET["error"] == "pwdsnotmatch") {
                        echo "<p class='text-center mt-2 text-danger'>Passwords don't match!</p>";
                    }
                    if ($_GET["error"] == "username-taken") {
                        echo "<p class='text-center mt-2 text-danger'>Username or Email already taken!</p>";
                    }
                    if ($_GET["error"] == "none") {
                        echo "<p class='text-center mt-2 text-success'>You have signed up!</p>";
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