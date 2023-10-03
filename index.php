<!DOCTYPE html>
<html>

<head>
    <title>Login -Online voting web app</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <div class="container h-100 ">
        <div class="d-flex flex-column justify-content-center align-items-center h-100">
                   <span class='d-flex justify-content-center align-items-center m-2'>
                 <?php 
                if(isset($_GET['registered'])){
                    ?>
                        <span class="alert alert-success" role="alert">Your account has been created successfully!</span>
                    <?php
                }else if(isset($_GET['not_registered'])){
                  ?>
                        <span class="alert alert-warning" role="alert">Sorry, you are not registered!</span>
                    <?php
                }else if(isset($_GET['invalid'])){
                  ?>
                        <span class="alert alert-danger" role="alert">Passwords mismatched please try again!</span>
                    <?php
                }else if(isset($_GET['invalid_access'])){
                  ?>
                        <span class="alert alert-danger" role="alert">Invalid username or password!</span>
                    <?php
                }
                
            ?>
    </span>
            <div class="user_card ">
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
                        <form method="POST">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="emailId" class="form-control input_user" value="" placeholder="Email-Id">
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" name="password" class="form-control input_pass" value="" placeholder="password">
                            </div>
                            <div class="d-flex justify-content-center mt-3 login_container">
                                <button type="submit" name="login-btn" class="btn login_btn">Login</button>
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

</body>

</html>

<?php
require_once('admin/includes/config.php');

if (isset($_POST['signUp-btn'])) {

    $su_emailId = mysqli_escape_string($db, $_POST['su_emailId']);
    $su_phoneNo = mysqli_escape_string($db, $_POST['su_phoneNo']);
    $su_pass = mysqli_escape_string($db, sha1($_POST['su_pass']));
    $su_cPass = mysqli_escape_string($db, sha1($_POST['su_cPass']));
    $su_user_role = 'voter';

    if ($su_pass == $su_cPass) {
        // insert Query
        mysqli_query($db, "INSERT INTO users(email_id,phone_no,password,user_role) VALUES('" . $su_emailId . "','" . $su_phoneNo . "','" . $su_pass . "','" . $su_user_role . "')")
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
}else if(isset($_POST['login-btn'])){
    $emailId = mysqli_real_escape_string($db,$_POST['emailId']);
    $password = mysqli_real_escape_string($db,sha1($_POST['password']));

    // Fetching Query / SELECT
    $fetchingData = mysqli_query($db, "SELECT * FROM users WHERE email_id = '". $emailId ."'") or die(mysqli_error($db));

    
    if(mysqli_num_rows($fetchingData) > 0){
        $data = mysqli_fetch_assoc($fetchingData);

        if($emailId === $data['email_id'] AND $password === $data['password']){

            session_start();
            $_SESSION['user_role'] = $data['user_role'];
            $_SESSION['email_id'] = $data['email_id'];

            if($data['user_role'] === 'Admin'){
                $_SESSION['key'] = "AdminKey";
             ?>
            <script>
                location.assign("admin/index.php");
             </script>
        <?php
            }else{
                $_SESSION['key'] = "VotersKey";
             ?>
            <script>
                location.assign("voters/index.php");
             </script>
        <?php
            }

        }else{
             ?>
            <script>
                location.assign("index.php?invalid_access=1");
             </script>
        <?php
        }

    }else{
         ?>
            <script>
                location.assign("index.php?sign-up=1&not_registered=1");
             </script>
        <?php
    }
}
?>