<!DOCTYPE html>
<html>

<head>
    <title>Login -Online voting web app</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="assets/images/vote-logo.jpg" class="brand_logo" alt="Logo">
                    </div>
                </div>

                <?php
                if (isset($_GET['sign-up'])) {
                ?>
                    <div class="d-flex justify-content-center form_container">
                        <form method='post'>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="email" name="su_emailId" class="form-control input_user" value="" placeholder="e-mail Id">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="number" name="su_phoneNo" class="form-control input_user" value="" inputmode="numeric" placeholder="phone No.">
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" name="su_pass" class="form-control input_pass" value="" placeholder="password">
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" name="su_cPass" class="form-control input_pass" value="" placeholder="confirm password">
                            </div>
                            <div class="d-flex justify-content-center mt-3 login_container">
                                <button type="submit" name="signUp-btn" class="btn login_btn">Submit</button>
                            </div>
                        </form>
                    </div>

                    <div class="mt-4">
                        <div class="d-flex justify-content-center links">
                            Already have an account? <a href="index.php" class="ml-2">Sign In</a>
                        </div>
                    </div>
                <?php
                } else {
                ?>
                    <div class="d-flex justify-content-center form_container">
                        <form>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="" class="form-control input_user" value="" placeholder="username">
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" name="" class="form-control input_pass" value="" placeholder="password">
                            </div>
                            <div class="d-flex justify-content-center mt-3 login_container">
                                <button type="submit" name="button" class="btn login_btn">Login</button>
                            </div>
                        </form>
                    </div>

                    <div class="mt-4">
                        <div class="d-flex justify-content-center links">
                            Don't have an account? <a href="?sign-up=1" class="ml-2">Sign Up</a>
                        </div>
                        <div class="d-flex justify-content-center links">
                            <a href="#">Forgot your password?</a>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>

<?php
require_once('admin/includes/config.php');

if (isset($_POST['signUp-btn'])) {

    $su_emailId = mysqli_escape_string($db, $_POST['su_emailId']);
    $su_phoneNo = mysqli_escape_string($db, $_POST['su_phoneNo']);
    $su_pass = mysqli_escape_string($db, $_POST['su_pass']);
    $su_cPass = mysqli_escape_string($db, $_POST['su_cPass']);
    $su_user_role = 'voter';

    if ($su_pass == $su_cPass) {
        // insert Query
        mysqli_query($db, "INSERT INTO users(email_id,phone_no,password,user_role) VALUES('" . $su_emailId . "','" . $su_phoneNo . "','" . $su_pass . "','" . $user_role . "')")
            or die(mysqli_error($db));
             ?>
            <script>
                location.assign("index.php?sign-up=1&registered=1");
             </script>
        <?php
    } else {
        ?>
            <script>
                location.assign("index.php?sign-up=1&invalid=1");
             </script>
        <?php
    }
}
?>