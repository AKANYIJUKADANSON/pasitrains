
<?php

    // Send verification token to email
    //Import PHPMailer classes into the global namespace
    //These must be at the top of the script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../email/vendor/phpmailer/phpmailer/src/Exception.php';
    require '../email/vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require '../email/vendor/phpmailer/phpmailer/src/SMTP.php';

    // function to send the verification details
    function send_verification_info($email, $verify_token)
    {

        try {
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'dantechx01@gmail.com';                     //SMTP username -> email to use to send data
            $mail->Password   = "yhxccopeidlcxcoh";                               //SMTP password
            // The paswd above was obtained from google to use on passwords after 2step verification
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;                                     //TCP port to connect to; use 587 if you have 

            //Recipients
            $mail->setFrom('dantechx01@gmail.com', "PASI Technologies");
            $mail->addAddress($email);                              //Add a recipient

            // Content
            $mail->isHTML(true);

            $emailTemplate = "
                        <h2>Your application has be successfully registered, verify your email to complete the application process </h2>
                        <br>
                        <a href='http://localhost/pasiv2/pages/email-verification.php?token=$verify_token'>Verify your email</a>
            ";
            // The link should be the one to be verified
            $mail->Subject = "Hello, thank you for applying to PASI Technologies";
            $mail->Body    = $emailTemplate;

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    if (isset($_POST['submit'])) {
        $email = "dantechx02@gmail.com";
        $verify_token = rand(0, 9999);

        if (send_verification_info($email, $verify_token)) {
            echo "<script>alert('Token was sent successfully'); </script>";
        }else{
            echo "<script>alert('Error while sending the token'); </script>";
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
        <!-- <div class="container"> -->

            <section class="section register min-vh-75 d-flex flex-column align-items-center justify-content-center pt-lg-5">
                <div class="container pt-lg-5">
                    <div class="row justify-content-center pt-lg-5">
                        <div class="col-lg-5 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <h3 style="font-size: 20px" class="d-none d-lg-block w-900">EMAIL VERIFICATION</h3>
                            </div><!-- End Logo -->

                            <div style="border-top: 4px solid deepskyblue;" class="card mb-3 py-5 col-md-6">

                            

                                <div class="card-body">
                                    <form action="verif.php" method="post" class="row g-3 needs-validation" novalidate>
                                        <div class="text-center">
                                            <input style="font-size: 25px" class="btn btn-sm btn-primary px-4" type="submit" name="submit" value="Verify">
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

        <!-- </div> -->
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <!-- validate -->

    <script src="../assets/js/sweetalert2.all.min.js"> </script>
    <script src="../assets/js/form-validation.js"></script>
</body>

</html>