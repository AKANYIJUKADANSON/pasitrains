<?php
session_start();
include('../inc/config.php');

// Generate the registration No. for each person that applys
function generateRegNo($course_initial, $timeZone)
{
    // Set the timezone to "Africa/Nairobi"
    date_default_timezone_set($timeZone);

    // Get the current date and time in the specified timezone
    $yr = date('y');
    $currentMonthDateTime = date('mdHis');

    /**
     * Student reg No. format "Year/TR/course/currentMonthDatetime"
     * Eg. 23/TR/MRM/1212083555
     */

    $applicant_reg_no = $yr . "/TR" . "/" . $course_initial . "/" . $currentMonthDateTime;
    // echo  $reg_no;
    return $applicant_reg_no;
}


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
        $mail->Username   = 'dantechx01@gmail.com';                     //SMTP username -> email to send the message to the applicant(Company email)
        $mail->Password   = "yhxccopeidlcxcoh";                               //SMTP password
        // The paswd above was obtained from google to use on passwords after 2step verification
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;                                     //TCP port to connect to; use 587 if you have 

        //Recipients (setFrom is company email and name)
        $mail->setFrom('dantechx01@gmail.com', "PASI Technologies");
        $mail->addAddress($email);                              //Add a recipient

        //Content
        $mail->isHTML(true);

        $emailTemplate = "
                            <p>Your application has be successful.</p>
                            <br>
                            <p>Verify your email to complete the application process</p>
                            <p> <b>$verify_token</b> is your verification token</p>
                        ";
        // The link should be the one to be verified
        $mail->Subject = "APPLICATION EMAIL VERIFICATION";
        $mail->Body    = $emailTemplate;

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

// Get short form for the course selected
if (isset($_POST['enrole'])) {
    $_SESSION['training'] = $_POST['training'];
    $_SESSION['initial'] = $_POST['initial'];
    $_SESSION['duration']  = $_POST['duration'];
}


$course_selected = $_SESSION['training'];
$initial = $_SESSION['initial'];
$duration = $_SESSION['duration'];

$reg_no = generateRegNo($initial, 'Africa/Nairobi');

if (isset($_POST['apply'])) {

    $fname = $_POST['firstName'];
    $mname = $_POST['middleName'];
    $lname = $_POST['lastName'];
    $dob = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $employer = $_POST['employer'];
    $country = $_POST['country'];
    $city = $_POST['addressCity'];
    $pobox = $_POST['addressBox'];
    $phone = $_POST['phone_number'];
    $email = $_POST['useremail'];
    $date_of_registration = date("Y-m-d");

    // Verification code
    $verify_token = rand(0, 9999);


    // Validatimg the email
    if (empty($email)) {
        $_SESSION['status'] = 'Email is required to proceed';
        $_SESSION['color'] = "danger";
    } elseif ($email) {
        //This will Remove all illegal characters from email
        $sanitizedEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
        // To Validate the email
        $newEmail = filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL);

        if ($newEmail) {
            $useremail = filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL);
        } else {
            $_SESSION['status'] = 'Invalid email id, missing \'@\' or contains unwanted characters';
            $_SESSION['color'] = "warning";
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // File upload directory 
        $targetDir = "../assets/uploads/";

        // Saving image and other related data
        if (!empty($_FILES["file"]["name"])) {
            $imageName = basename($_FILES["file"]["name"]);
            $targetFilePath = $targetDir . $imageName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            // Allow certain file formats 
            $allowTypes = array('jpg', 'JPG', 'png', 'PNG');

            if (in_array($fileType, $allowTypes)) {
                // Upload file to server 
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                    // Insert image file name and post data into database 

                    $insert = "INSERT INTO applications(firstName, middleName, lastName, reg_no, course, duration, dob, gender, employer, country, city, postalAddress, profilePicture, email, phone, reg_date, verify_token)
                    VALUES('$fname', '$mname', '$lname', '$reg_no','$course_selected', '$duration', '$dob', '$gender', '$employer', '$country', '$city', '$pobox', '$imageName', '$useremail', '$phone', '$date_of_registration', '$verify_token')";

                    // $stmt = "INSERT INTO applications(firstName, middleName, lastName)VALUES('$fname', '$mname', '$lname')";

                    $query_run = mysqli_query($conn, $insert);


                    // echo $reg_no, $course_selected, $course_initial, $duration, $fname, $mname, $lname, $dob, $gender, $employer, $country, $city, $pobox, $phone, $email, $date_of_registration;

                    if ($query_run) {
                        // Sending a verification token to the email
                        send_verification_info($useremail, $verify_token);

                        session_unset();
                        $_SESSION['reg_no'] = $reg_no;
                        // header('location:email-verification.php');
?>
                        <script>
                            // alert("No course was selected, Please select a course to proceed");
                            window.location.href = "email-verification.php";
                        </script>
<?php
                    } else {
                        $_SESSION['status'] = "Error while saving your application, please try again";
                        $_SESSION['color'] = "danger";
                    }
                } else {
                    $_SESSION['status'] = "Sorry, there was an error uploading image";
                    $_SESSION['color'] = "danger";
                }
            } else {
                $_SESSION['status'] = 'Sorry, only JPG, PNG images with only numbers and letters are allowed to be uploaded';
                $_SESSION['color'] = "danger";
            }
        } else {
            $imageName = "default_img.png";

            // echo $reg_no, $course_selected, $initial, $duration, $fname, $mname, $lname, $dob, $gender, $employer, $country, $city, $pobox, $phone, $email, $date_of_registration;


            $insert = "INSERT INTO applications(firstName, middleName, lastName, reg_no, course, duration, dob, gender, employer, country, city, postalAddress, profilePicture, email, phone, reg_date, verify_token)VALUES('$fname', '$mname', '$lname', '$reg_no','$course_selected', '$duration', '$dob', '$gender', '$employer', '$country', '$city', '$pobox', '$imageName', '$useremail', '$phone', '$date_of_registration','$verify_token')";

            $query_run = mysqli_query($conn, $insert);

            if ($query_run) {
                // Sending a verification token to the email
                send_verification_info($useremail, $verify_token);

                session_unset();
                $_SESSION['reg_no'] = $reg_no;
                header('location:email-verification.php');
                // header("location:email-verification.php?reg_no=$reg_no");
            } else {
                $_SESSION['status'] = "Error while saving your application, please try again";
                $_SESSION['color'] = "danger";
            }
        }
    }
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/img/favicon/favicon-16x16.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/sweetalert2.min.css">

</head>

<body>

    <div class="container-fluid col-xxl-12">
        <!-- ======= Header ======= -->
        <nav class="navbar navbar-expand-lg bg-body-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img height="90" width="170" src="../assets/img/pasi_logo.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                About Us
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">About PASI</a></li>
                                <li><a class="dropdown-item" href="#">Our Core Values</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">Services</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Trainings
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="training-calendar.php">Training Calendar</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Annual Conference</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Industry</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact Us</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav><!-- End Header -->

        <div class="row col-md-12 mx-auto">
            <div class="col-sm-6  my-2 text-primary">
                <h2>TRAINING APPLICATION FORM</h2>
            </div>

            <div class="col-sm-6 my-2">
                <h4 style="text-align: end;"><b>Reg No.:</b> <span class=" text-danger"><?= $reg_no; ?></span></h4>
            </div>
        </div>

        <hr class="col-md-12">
        <?php
        if (isset($_SESSION['status']) && $color = $_SESSION['color']) { ?>

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
        unset($_SESSION['status']);
        unset($_SESSION['color']);
        ?>
        <div class="row col-md-12 mt-6">
            <div class="col-md-6">
                <h4><b>Training In:</b> <span class="text-secondary"><?= $course_selected; ?><b>(<?= $initial; ?>)</b> </span></h4>
            </div>

            <div class="col-md-3 ">
                <h4><b>Duration:</b> <span class="text-secondary"><?= $duration; ?></span></h4>
            </div>
        </div>

        <div class="row justify-content-center ">
            <form class="row g-3 mb-5" method="POST" action="" name="appForm" onsubmit="return(validate())" enctype="multipart/form-data">
                <div class="col-md-4">
                    <label class="form-label">First Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="inputFirstName" name="firstName">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="inputMiddleName" name="middleName">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Last Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="lastName">
                </div>

                <div class="col-md-4">
                    <label for="inputDOB" class="form-label">Date Of Birth</label>
                    <input type="date" class="form-control" id="inputDOB" name="date_of_birth">
                </div>

                <div class="col-md-4">
                    <label for="inputGender" class="form-label">Gender</label>
                    <select id="inputGender" class="form-select" name="gender">
                        <option selected></option>
                        <option value="MALE">Male</option>
                        <option value="FEMALE">Female</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="inputEmployer" class="form-label">Employer<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="inputEmployer" name="employer">
                </div>


                <hr>
                <label for="country" class="form-label"><b>Address</b><span class="text-danger">*</span></label>
                <div class="col-md-4">
                    <label for="country" class="form-label">Country<span class="text-danger">*</span></label>
                    <select name="country" class="form-select">
                        <option value="">Choose Country</option>
                        <option value="Afghanistan">Afghanistan</option>
                        <option value="Åland Islands">Åland Islands</option>
                        <option value="Albania">Albania</option>
                        <option value="Algeria">Algeria</option>
                        <option value="American Samoa">American Samoa</option>
                        <option value="Andorra">Andorra</option>
                        <option value="Angola">Angola</option>
                        <option value="Anguilla">Anguilla</option>
                        <option value="Antarctica">Antarctica</option>
                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Armenia">Armenia</option>
                        <option value="Aruba">Aruba</option>
                        <option value="Australia">Australia</option>
                        <option value="Austria">Austria</option>
                        <option value="Azerbaijan">Azerbaijan</option>
                        <option value="Bahamas">Bahamas</option>
                        <option value="Bahrain">Bahrain</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Barbados">Barbados</option>
                        <option value="Belarus">Belarus</option>
                        <option value="Belgium">Belgium</option>
                        <option value="Belize">Belize</option>
                        <option value="Benin">Benin</option>
                        <option value="Bermuda">Bermuda</option>
                        <option value="Bhutan">Bhutan</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                        <option value="Botswana">Botswana</option>
                        <option value="Bouvet Island">Bouvet Island</option>
                        <option value="Brazil">Brazil</option>
                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                        <option value="Bulgaria">Bulgaria</option>
                        <option value="Burkina Faso">Burkina Faso</option>
                        <option value="Burundi">Burundi</option>
                        <option value="Cambodia">Cambodia</option>
                        <option value="Cameroon">Cameroon</option>
                        <option value="Canada">Canada</option>
                        <option value="Cape Verde">Cape Verde</option>
                        <option value="Cayman Islands">Cayman Islands</option>
                        <option value="Central African Republic">Central African Republic</option>
                        <option value="Chad">Chad</option>
                        <option value="Chile">Chile</option>
                        <option value="China">China</option>
                        <option value="Christmas Island">Christmas Island</option>
                        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Comoros">Comoros</option>
                        <option value="Congo">Congo</option>
                        <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                        <option value="Cook Islands">Cook Islands</option>
                        <option value="Costa Rica">Costa Rica</option>
                        <option value="Cote D'ivoire">Cote D'ivoire</option>
                        <option value="Croatia">Croatia</option>
                        <option value="Cuba">Cuba</option>
                        <option value="Cyprus">Cyprus</option>
                        <option value="Czech Republic">Czech Republic</option>
                        <option value="Denmark">Denmark</option>
                        <option value="Djibouti">Djibouti</option>
                        <option value="Dominica">Dominica</option>
                        <option value="Dominican Republic">Dominican Republic</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="Egypt">Egypt</option>
                        <option value="El Salvador">El Salvador</option>
                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                        <option value="Eritrea">Eritrea</option>
                        <option value="Estonia">Estonia</option>
                        <option value="Ethiopia">Ethiopia</option>
                        <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                        <option value="Faroe Islands">Faroe Islands</option>
                        <option value="Fiji">Fiji</option>
                        <option value="Finland">Finland</option>
                        <option value="France">France</option>
                        <option value="French Guiana">French Guiana</option>
                        <option value="French Polynesia">French Polynesia</option>
                        <option value="French Southern Territories">French Southern Territories</option>
                        <option value="Gabon">Gabon</option>
                        <option value="Gambia">Gambia</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Germany">Germany</option>
                        <option value="Ghana">Ghana</option>
                        <option value="Gibraltar">Gibraltar</option>
                        <option value="Greece">Greece</option>
                        <option value="Greenland">Greenland</option>
                        <option value="Grenada">Grenada</option>
                        <option value="Guadeloupe">Guadeloupe</option>
                        <option value="Guam">Guam</option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="Guernsey">Guernsey</option>
                        <option value="Guinea">Guinea</option>
                        <option value="Guinea-bissau">Guinea-bissau</option>
                        <option value="Guyana">Guyana</option>
                        <option value="Haiti">Haiti</option>
                        <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                        <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Hong Kong">Hong Kong</option>
                        <option value="Hungary">Hungary</option>
                        <option value="Iceland">Iceland</option>
                        <option value="India">India</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                        <option value="Iraq">Iraq</option>
                        <option value="Ireland">Ireland</option>
                        <option value="Isle of Man">Isle of Man</option>
                        <option value="Israel">Israel</option>
                        <option value="Italy">Italy</option>
                        <option value="Jamaica">Jamaica</option>
                        <option value="Japan">Japan</option>
                        <option value="Jersey">Jersey</option>
                        <option value="Jordan">Jordan</option>
                        <option value="Kazakhstan">Kazakhstan</option>
                        <option value="Kenya">Kenya</option>
                        <option value="Kiribati">Kiribati</option>
                        <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                        <option value="Korea, Republic of">Korea, Republic of</option>
                        <option value="Kuwait">Kuwait</option>
                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                        <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                        <option value="Latvia">Latvia</option>
                        <option value="Lebanon">Lebanon</option>
                        <option value="Lesotho">Lesotho</option>
                        <option value="Liberia">Liberia</option>
                        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                        <option value="Liechtenstein">Liechtenstein</option>
                        <option value="Lithuania">Lithuania</option>
                        <option value="Luxembourg">Luxembourg</option>
                        <option value="Macao">Macao</option>
                        <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                        <option value="Madagascar">Madagascar</option>
                        <option value="Malawi">Malawi</option>
                        <option value="Malaysia">Malaysia</option>
                        <option value="Maldives">Maldives</option>
                        <option value="Mali">Mali</option>
                        <option value="Malta">Malta</option>
                        <option value="Marshall Islands">Marshall Islands</option>
                        <option value="Martinique">Martinique</option>
                        <option value="Mauritania">Mauritania</option>
                        <option value="Mauritius">Mauritius</option>
                        <option value="Mayotte">Mayotte</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                        <option value="Moldova, Republic of">Moldova, Republic of</option>
                        <option value="Monaco">Monaco</option>
                        <option value="Mongolia">Mongolia</option>
                        <option value="Montenegro">Montenegro</option>
                        <option value="Montserrat">Montserrat</option>
                        <option value="Morocco">Morocco</option>
                        <option value="Mozambique">Mozambique</option>
                        <option value="Myanmar">Myanmar</option>
                        <option value="Namibia">Namibia</option>
                        <option value="Nauru">Nauru</option>
                        <option value="Nepal">Nepal</option>
                        <option value="Netherlands">Netherlands</option>
                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                        <option value="New Caledonia">New Caledonia</option>
                        <option value="New Zealand">New Zealand</option>
                        <option value="Nicaragua">Nicaragua</option>
                        <option value="Niger">Niger</option>
                        <option value="Nigeria">Nigeria</option>
                        <option value="Niue">Niue</option>
                        <option value="Norfolk Island">Norfolk Island</option>
                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                        <option value="Norway">Norway</option>
                        <option value="Oman">Oman</option>
                        <option value="Pakistan">Pakistan</option>
                        <option value="Palau">Palau</option>
                        <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                        <option value="Panama">Panama</option>
                        <option value="Papua New Guinea">Papua New Guinea</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Peru">Peru</option>
                        <option value="Philippines">Philippines</option>
                        <option value="Pitcairn">Pitcairn</option>
                        <option value="Poland">Poland</option>
                        <option value="Portugal">Portugal</option>
                        <option value="Puerto Rico">Puerto Rico</option>
                        <option value="Qatar">Qatar</option>
                        <option value="Reunion">Reunion</option>
                        <option value="Romania">Romania</option>
                        <option value="Russian Federation">Russian Federation</option>
                        <option value="Rwanda">Rwanda</option>
                        <option value="Saint Helena">Saint Helena</option>
                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                        <option value="Saint Lucia">Saint Lucia</option>
                        <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                        <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                        <option value="Samoa">Samoa</option>
                        <option value="San Marino">San Marino</option>
                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                        <option value="Saudi Arabia">Saudi Arabia</option>
                        <option value="Senegal">Senegal</option>
                        <option value="Serbia">Serbia</option>
                        <option value="Seychelles">Seychelles</option>
                        <option value="Sierra Leone">Sierra Leone</option>
                        <option value="Singapore">Singapore</option>
                        <option value="Slovakia">Slovakia</option>
                        <option value="Slovenia">Slovenia</option>
                        <option value="Solomon Islands">Solomon Islands</option>
                        <option value="Somalia">Somalia</option>
                        <option value="South Africa">South Africa</option>
                        <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                        <option value="Spain">Spain</option>
                        <option value="Sri Lanka">Sri Lanka</option>
                        <option value="Sudan">Sudan</option>
                        <option value="Suriname">Suriname</option>
                        <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                        <option value="Swaziland">Swaziland</option>
                        <option value="Sweden">Sweden</option>
                        <option value="Switzerland">Switzerland</option>
                        <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                        <option value="Taiwan">Taiwan</option>
                        <option value="Tajikistan">Tajikistan</option>
                        <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Timor-leste">Timor-leste</option>
                        <option value="Togo">Togo</option>
                        <option value="Tokelau">Tokelau</option>
                        <option value="Tonga">Tonga</option>
                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                        <option value="Tunisia">Tunisia</option>
                        <option value="Turkey">Turkey</option>
                        <option value="Turkmenistan">Turkmenistan</option>
                        <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                        <option value="Tuvalu">Tuvalu</option>
                        <option value="Uganda">Uganda</option>
                        <option value="Ukraine">Ukraine</option>
                        <option value="United Arab Emirates">United Arab Emirates</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="United States">United States</option>
                        <option value="Uruguay">Uruguay</option>
                        <option value="Uzbekistan">Uzbekistan</option>
                        <option value="Vanuatu">Vanuatu</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Viet Nam">Viet Nam</option>
                        <option value="Virgin Islands, British">Virgin Islands, British</option>
                        <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                        <option value="Wallis and Futuna">Wallis and Futuna</option>
                        <option value="Western Sahara">Western Sahara</option>
                        <option value="Yemen">Yemen</option>
                        <option value="Zambia">Zambia</option>
                        <option value="Zimbabwe">Zimbabwe</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">City</label>
                    <input type="text" class="form-control" id="inputCity" placeholder="Kampala" name="addressCity">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Postal Address</label>
                    <input type="text" class="form-control" name="addressBox" placeholder="P.O.BOX....">
                </div>


                <div class="col-md-4">
                    <p><img id="output" width="100" height="100" /></p>
                    <input type="file" accept="image/*" onchange="loadFile(event)" name="file">
                    <script>
                        var loadFile = function(event) {
                            var image = document.getElementById('output');
                            image.src = URL.createObjectURL(event.target.files[0]);
                        };
                    </script>
                </div>

                <div class="col-md-4">
                    <label for="inputEmail" class="form-label mt-5">Email<span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="inputEmail" placeholder="example@gmail.com" name="useremail">
                </div>
                <div class="col-md-4">
                    <label for="inputPhone" class="form-label mt-5">Phone Number<span class="text-danger">*</span></label>
                    <input type="tel" class="form-control" id="inputPhone" placeholder="2567792....." name="phone_number">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary bx-4" name="apply">Apply</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <!-- validate -->
    <script src="../assets/js/form-validation.js"></script>

    <script src="../assets/js/sweetalert2.all.min.js"> </script>

    <script>
        function sweatAlert2() {
            return Swal.fire({
                title: "Application sent successfully",
                icon: "Success",
            });
        }
    </script>
</body>

</html>