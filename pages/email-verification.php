<?php
session_start();
include('../inc/config.php');

$reg_no = $_SESSION['reg_no'];
// echo "My reg No = " . $reg_no;

if (isset($_POST['verify'])) {

    // Capture user token from input
    $user_token = $_POST['user_token'];
    // echo "User token  =". $user_token;

    // Get the token from db
    $query = "SELECT * FROM applications where reg_no = '$reg_no' LIMIT 1";
    $query_run = mysqli_query($conn, $query);
    $rows = mysqli_fetch_assoc($query_run);
    $dbVerificationToken = $rows['verify_token'];

    // echo "db token = ". $dbVerificationToken;

    // check if the verification status is 0, and if its1 then already verified
    if ($rows['emailVerifStatus'] == 0) {
        // Compare the two tokens (if the same change status to 1 if no then wrong code from user)
        if ($user_token == $dbVerificationToken) {
            // Update the status to 1
            $update = "UPDATE applications SET emailVerifStatus = '1' WHERE reg_no = '$reg_no' ";

            $update_run = mysqli_query($conn, $update);
            if ($update_run) {
                session_unset();
                session_destroy();
                $_SESSION['verif_status'] = 1;
                ?>
                    <script>
                        // alert("No course was selected, Please select a course to proceed");
                        window.location.href = "verif_success.php";
                    </script>
                <?php
            } else {

                echo '
                        <script src="../assets/js/sweetalert2.all.min.js"> </script>
                        <script>
                            Swal.fire({
                            title: "Email Verification Status",
                            text: "Your email has not been verified, either a wrong token has been used.Please try again!",
                            icon: "error",
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "OK"
                            });

                            window.history.forward();
                        </script>
                        ';
            }
        } else {
            echo '
                    <script src="../assets/js/sweetalert2.all.min.js"> </script>
                    <script>
                        Swal.fire({
                        title: "Email Verification",
                        text: "Error while verifying your email, either a wrong token has been used.Please try again!",
                        icon: "error",
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "OK"
                        });

                        window.history.forward();
                    </script>
                ';
        }
    } else {
        $_SESSION['status'] = "Your email is already verified";
        echo "Your email is already verified";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PASI | Email Verification</title>
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/sweetalert2.min.css">

</head>

<body>
    <main>
        <div class="container">

            <section class="section register min-vh-75 d-flex flex-column align-items-center justify-content-center pt-lg-5">
                <div class="container pt-lg-5">
                    <div class="row justify-content-center pt-lg-5">
                        <div class="col-lg-5 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <h3 style="font-size: 20px" class="d-none d-lg-block w-900">EMAIL VERIFICATION</h3>
                            </div><!-- End Logo -->

                            <div style="border-top: 4px solid deepskyblue;" class="card mb-3">

                                <div class="card-body">

                                    <div class="pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4"></h5>
                                        <p style="font-size: 18px" class="">Use the token sent to your email to complete the application process</p>
                                    </div>

                                    <form method="post" action="email-verification.php" class="row g-3 needs-validation" novalidate>

                                        <div class="col-12">
                                            <div class="input-group has-validation">
                                                <input style="height: 50px; font-size: 20px; font-weight:500" type="number" name="user_token" class="form-control text-secondary" placeholder="Enter code here" required>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <input style="font-size: 18px" class="btn btn-sm btn-primary float-start px-4" type="submit" name="verify" value="Verify">

                                            <input style="font-size: 18px" class="btn btn-danger float-end" type="submit" name="submit" value="Resend Code">
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <!-- validate -->

    <script src="../assets/js/sweetalert2.all.min.js"> </script>
    <script src="../assets/js/form-validation.js"></script>
</body>

</html>