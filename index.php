<!DOCTYPE html>
<html>

<head>
    <title>Login -Online voting web app</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<!--Coded with love by Mutiullah Samim-->

<body>
    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="assets/images/vote-logo.jpg" class="brand_logo" alt="Logo">
                    </div>
                </div>
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
                            <button type="button" name="button" class="btn login_btn">Login</button>
                        </div>
                    </form>
                </div>

                <div class="mt-4">
                    <div class="d-flex justify-content-center links">
                        Don't have an account? <a href="#" class="ml-2">Sign Up</a>
                    </div>
                    <div class="d-flex justify-content-center links">
                        <a href="#">Forgot your password?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
</body>

</html>