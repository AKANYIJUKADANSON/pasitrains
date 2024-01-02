<?php
session_start();
include('../inc/config.php');

// get logged in user
if (isset($_SESSION['login_user']) && isset($_SESSION['auth'])) {
    $approvePersonnel = $_SESSION['login_user'];
    // echo $approvePersonnel;
} else {
    $_SESSION['status'] = "First login";
    $_SESSION['color'] = "danger";
    session_destroy();
    header('location:index.php');
}
$applicants = "SELECT * FROM applications";
$applicants_query = mysqli_query($conn, $applicants);


// Approving
if (isset($_POST['approve'])) {
    $rows = mysqli_fetch_assoc($applicants_query);
    $reg_no = $rows['reg_no'];

    // Updating the status ( from 0 to 1)
    $update = "UPDATE applications SET applicationStatus = 1, approvedBy = '$approvePersonnel' ";
    $update_run = mysqli_query($conn, $update);
    if ($update_run) {
        header('location:appVerifSuccess.php');
    }
}

// logging out
if (isset($_POST['logout'])) {
    session_destroy();
?>
    <script>
        confirm("Are you sure to logout?");
        window.location.href = "index.php";
        window.history.forwad();
    </script>
<?php
}





// Updating data
if (isset($_POST['update'])) {

    // Get the reg_no. of the current user
    $reg_no_to_update = $_POST['updateRegNo'];

    // $profile_image = $_POST['profileImage'];
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


    // Validatimg the email
    if (!empty($email)) {
        //This will Remove all illegal characters from email
        $sanitizedEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
        // To Validate the email
        $newEmail = filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL);

        if ($newEmail) {
            $useremail = filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL);
        } else {
            $_SESSION['status'] = 'Invalid email id, missing \'@\' or contains unwanted characters';
            $_SESSION['color'] = "danger";
        }
    }

    // echo "Reg Number= ". $reg_no_to_update, $fname, $mname, $lname, $dob, $gender, $employer, $country, $city, $pobox, $phone, $useremail, $profile_image;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // File upload directory 
        $targetDir = "../assets/uploads/";

        /**
         * ==========================================================
         * First, get the image in the db and compare with the one uploaded for update
         * if the image name is same as the previous one(not changed), then we leave it and if changed, the former is first deleted, then a new one uploaded
         */



























         
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

                    $insert = "INSERT INTO applications(firstName, middleName, lastName, reg_no, course, duration, start_date, dob, gender, employer, country, city, postalAddress, profilePicture, email, phone, reg_date, verify_token)
                    VALUES('$fname', '$mname', '$lname', '$reg_no','$course_selected', '$duration', '$start_date', '$dob', '$gender', '$employer', '$country', '$city', '$pobox', '$imageName', '$useremail', '$phone', '$date_of_registration', '$verify_token')";

                    // $stmt = "INSERT INTO applications(firstName, middleName, lastName)VALUES('$fname', '$mname', '$lname')";

                    $query_run = mysqli_query($conn, $insert);


                    // echo $reg_no, $course_selected, $course_initial, $duration, $start_date, $fname, $mname, $lname, $dob, $gender, $employer, $country, $city, $pobox, $phone, $email, $date_of_registration;

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

            // echo $reg_no, $course_selected, $initial, $duration, $start_date, $fname, $mname, $lname, $dob, $gender, $employer, $country, $city, $pobox, $phone, $email, $date_of_registration;


            $insert = "INSERT INTO applications(firstName, middleName, lastName, reg_no, course, duration, start_date, dob, gender, employer, country, city, postalAddress, profilePicture, email, phone, reg_date, verify_token)VALUES('$fname', '$mname', '$lname', '$reg_no','$course_selected', '$duration', '$start_date', '$dob', '$gender', '$employer', '$country', '$city', '$pobox', '$imageName', '$useremail', '$phone', '$date_of_registration','$verify_token')";

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












    // Update profile
    $update = "UPDATE applications SET firstName = '$fname', middleName = '$mname' WHERE reg_no = '$reg_no_to_update' ";

    // $update_run = mysqli_query($conn, $update);
    // if ($update_run) {
    //     $_SESSION['status'] = "Updated successfully";
    //     $_SESSION['color'] = "success";
    //     header('location:applicants-list.php');
    // } else {
    //     $_SESSION['status'] = "Error while updating the profile data!";
    //     $_SESSION['color'] = "danger";
    // }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PASI|Applicants</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/img/favicon/favicon-16x16.png">

    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">


</head>

<body>

    <!-- ======= Header ======= -->
    <nav class="navbar navbar-expand-lg bg-white">
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
                            <li><a class="dropdown-item" href="../pages/training-calendar.php">Training Calendar</a></li>
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

                    <li class="nav-item">
                        <?php if ($_SESSION['auth'] == true) { ?>
                            <form action="applicants-list.php" method="post">
                                <button type="submit" name="logout" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Logout"><i class="bi bi-power fs-6"></i></button>
                            </form>
                        <?php } ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav><!-- End Header -->


    <!-- Full Screen Modal -->

    <div class="modal fade" id="fullscreenModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">APPLICANT DETAILS</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body">
                    <?php include('applicant-details.php'); ?>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div><!-- End Full Screen Modal-->

    <div class=" card">
        <?php
        if (isset($_SESSION['status']) && isset($_SESSION['color'])) {
            $color = $_SESSION['color']; ?>

            <!-- Notification div -->
            <div class='alert alert-<?php echo $color; ?> d-flex alert-dismissible align-items-center' role='alert'>
                <i class="bi bi-unlock-fill mx-4 mb-2 text-success" style="font-size: 1.5rem;"></i>
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

        <div class="card-body table-responsive">
            <h3 class="text-primary my-4">LIST OF APPLICANTS</h3>



            <table id="applicants-table" class="table table-bordered table-responsive datatable py-4">
                <thead>
                    <tr class="text-primary">
                        <!-- <th scope="col">#</th> -->
                        <th scope="col">Reg No.</th>
                        <th scope="col">Name</th>
                        <th scope="col">Training</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Phone No.</th>
                        <th scope="col">Useremail</th>
                        <th class="text-success">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($applicants = mysqli_fetch_assoc($applicants_query)) {
                    ?>
                        <tr>
                            <th scope="row"><?= $applicants['reg_no']; ?> </th>
                            <td><?= $applicants['firstName'] . " "; ?><?= $applicants['lastName']; ?></td>
                            <td><?= $applicants['course']; ?></td>
                            <td><?= $applicants['duration']; ?></td>
                            <td><?= $applicants['phone']; ?></td>
                            <td><?= $applicants['email']; ?></td>
                            <td class="d-flex flex-column">

                                <a href="#" id="<?php echo $applicants['reg_no']; ?>" class="btn btn-sm btn-primary text-light view_applicant" data-toggle="modal" data-target="#closeXBtn">
                                    <i class="bi bi-eye-fill pe-2"></i>View</a>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>



        </div>
    </div>


    <!-- jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js">
    </script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

    <!-- MDB -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script src="../assets/js/data-tables.js"></script>



    <!-- Modals -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>



    <!-- Script to send data to the modal -->
    <script type="text/javascript">
        $(document).ready(function() {
            // Class of the element and the event (clicking and class of button)
            $(document).on('click', '.view_applicant', function() {
                // Get the value of the attribute in the button
                var reg_no = $(this).attr('id');
                $.ajax({
                    // The location of file to display and forward the id of specific data
                    url: "applicant-details.php",
                    // Method used to send data to the model
                    type: "post",
                    data: {
                        // Whatever is put in the attribute sent is posted here
                        reg_no: reg_no
                    },
                    success: function(data) {
                        // Id of the modal body
                        $("#modal-body").html(data);
                        // Id of the modal below
                        $("#fullscreenModal").modal('show');
                    }
                });
            });
        });
    </script>

    <!-- Initializing all tooltips -->
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

</body>

</html>