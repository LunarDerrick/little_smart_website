<!DOCTYPE html>
<html lang="en">

<?php
require_once("init_db.php");
include_once "helper_userinfo.php";

$loggedInFailed = false;

# only run if is set
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    # retrieve post variable
    $username = $_POST["username"];
    $password = $_POST["password"];
    if ($userinfo = verifyUsername($conn, $username)){
        # verify password   
        if(password_verify($password, $userinfo["password"])){
            header("Location: login_admin_temp.html");
            die; # prevent if browser dont respect redirect
        } else {
            // incorrect password
            $loggedInFailed = true;
        }
    } else {
        // no username found
        $loggedInFailed = true;
    }
}
?>

<head>
    <title>Login - Little Smart Day Care Centre</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Bootstrap implementation-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!--CSS overwrite-->
        <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <nav class="navbar navbar-expand navbar-light bg-custom">
        <a class="navbar-brand" href="index.html">
            <img src="media/logo.png" class="d-inline-block align-top" alt="day care centre logo">
        </a>

        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="login.html">Teacher Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about.html">About Us</a>
            </li>
        </ul>
    </nav>

    <section>
        <p id="PC">You are now viewing as <b>Computer</b>.</p>
        <p id="tablet">You are now viewing as <b>Tablet</b>.</p>
        <p id="mobile">You are now viewing as <b>Mobile Device</b>.</p>

        <div id="form-container">
            <div>
                <h1>Teacher Login</h1>
            </div>
            <form action="" method="POST">
                <div class="form-group row">
                    <label for="username" class="col-sm-3 col-form-label">Username:</label>
                    <div class="col-sm">
                        <input type="text" class="form-control login-field" id="username" name="username" placeholder="type here..." required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-3 col-form-label">Password:</label>
                    <div class="col-sm">
                        <input type="password" class="form-control login-field" id="password" name="password" placeholder="type here..." required>
                    </div>
                </div>
                <p></p>
                <div class="form-group row">
                    <div class="col-sm">
                        <button type="submit" class="btn btn-primary">LOGIN</button>
                    </div>
                </div>
            </form>
            <p></p>
            <div class="row" id="corner">
                <a href="#">Forgot password?</a>
            </div>
        </div>

        <br>
    </section>

    <footer>
        <small><i>
            © 2024 Little Smart Day Care Centre
        </i></small>
    </footer>
    <br>

    <!-- items for notification toast -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

    <script>
        <?php
        // warn if failed to login
            if ($loggedInFailed) {
                echo <<< FAILEDLOGIN
                new Notyf().error("Username or password is incorrect.")
                FAILEDLOGIN;
            }
        ?>  
    </script>
</body>

</html>