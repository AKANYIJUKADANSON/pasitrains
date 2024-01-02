<?php
session_start();
include('../inc/config.php');

// if (!isset($_SESSION['auth'])) {
//     header('location:index.php');
// }

if (isset($_POST['login'])) {
    $useremail = $_POST['useremail'];
    $user_password = $_POST['password'];

    // echo "Email ->".$useremail. "Password ->". $user_password;

    $login = "SELECT * FROM admin WHERE email = '$useremail' && status = 1 LIMIT 1 ";
    $login_run = mysqli_query($conn, $login);

    if ($admin = mysqli_fetch_assoc($login_run)) {
        $db_password = $admin['password'];
        if ($db_password == $user_password) {
            $_SESSION['login_user'] = $admin['name'];
            $_SESSION['auth'] = true;
            header('location:applicants-list.php');
            $_SESSION['status'] = "login successfully";
            $_SESSION['color'] = "success";


            echo "<script>
            window.history.forward();
        </script>";
        } else {
            $_SESSION['status'] = "Incorrect password";
            $_SESSION['color'] = "danger";
        }
    } else {
        $_SESSION['status'] = "Error logging in, wrong password or email";
        $_SESSION['color'] = "danger";
        // echo "Error logging in, wrong password or email";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>PASI | Login</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/img/favicon/favicon-16x16.png">



    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="../assets/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <main id="login_main">
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <?php
                            if (isset($_SESSION['status']) && isset($_SESSION['color'])) {
                                $color = $_SESSION['color']; ?>

                                <!-- Notification div -->
                                <div class='alert alert-<?php echo $color; ?> d-flex alert-dismissible align-items-center' role='alert'>
                                    <i class="bi bi-exclamation-triangle-fill mx-4 mb-2 text-warning" style="font-size: 1.5rem;"></i>
                                    <div>
                                        <h5> <?= $_SESSION['status']; ?> </h5>
                                        <!-- Button to close/Dismiss the alert -->
                                        <button class="btn-close" type="button" aria-label="close" data-bs-dismiss="alert"></button>
                                    </div>
                                </div>

                            <?php
                            }
                            // unset($_SESSION['status']);
                            // unset($_SESSION['color']);
                            ?>

                            <div class="d-flex justify-content-center py-4">
                                <div class=" logo d-flex align-items-center w-auto">


                                    <!-- <a href="index.html" class="logo d-flex align-items-center w-auto"> -->
                                    <img class="rounded-circle" height="40" width="40" src="../assets/img/favicon/favicon-32x32.png" alt="">
                                    <h3 class="d-none d-lg-block fw-bolder cart-title my-auto text-white ms-4">PASI Admin Login</h3>
                                    <!-- </a> -->
                                </div>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4"></h5>
                                        <p class="text-center small">Enter your email & password to login</p>
                                    </div>

                                    <form method="post" action="index.php" class="row g-3 needs-validation" novalidate>

                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Email</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="email" name="useremail" class="form-control" id="yourEmail" required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <div class="input-group has-validation">

                                                <input id="password" type="password" name="password" class="form-control" id="yourPassword" required>
                                                <span class="input-group-text" onclick="password_show_hide();">
                                                    <i class="bi bi-eye" id="show_eye"></i>
                                                    <i class="bi bi-eye-slash d-none" id="hide_eye"></i>
                                                </span>

                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit" name="login">Login</button>
                                        </div>
                                        <div class="col-12">
                                            <!-- <p class="small mb-0">Don't have account? <a href="pages-register.html">Create an account</a></p> -->
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <!-- Toggoling the password -->
    <script>
        function password_show_hide() {
            var x = document.getElementById("password");
            var show_eye = document.getElementById("show_eye");
            var hide_eye = document.getElementById("hide_eye");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";

            }
        }
    </script>
</body>

</html>