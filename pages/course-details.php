<?php
session_start();
include('../inc/config.php');
// Get course id
if (isset($_POST['more_details'])){
    $course_id = $_POST['course_id'];
    // echo $course_id;

        // Get the course details for specific course selected
    $query = "SELECT * FROM training_calendar WHERE code = $course_id";
    $query_run = mysqli_query($conn, $query);

    $rows = mysqli_fetch_assoc($query_run);

    // $data = mysqli_fetch_assoc($query_run);
    // $_SESSION['course_id'] = $course_id;
    // $_SESSION['training'] = $data['training'];
    // $_SESSION['initial'] = $data['initial'];
    // $_SESSION['duration'] = $rodataws['duration'];
    // $_SESSION['start_date'] = $data['start_date'];
}else{
    // echo "No course was selected";
    $_SESSION['status'] = "Please select a course of choice to proceed";
?>
    <script>
        alert("No course was selected, Please select a course to proceed");
        window.location.href = "training-calendar.php";
    </script>
<?php
}


// $data = mysqli_fetch_assoc($query_run);
// $_SESSION['course_id'] = $course_id;
// $_SESSION['training'] = $data['training'];
// $_SESSION['initial'] = $data['initial'];
// $_SESSION['duration'] = $rodataws['duration'];
// $_SESSION['start_date'] = $data['start_date'];

// if ($num_rows == 1) {
//     echo "Successwith a ". $num_rows;
// }else{
//     echo "Failure with ". $num_rows;
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PASI|Course Details</title>
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <?php include('../inc/navbar.php'); ?>

    <!-- ==================End of hero div================== -->
    <div class="row mt-4 mx-1">
        <!-- Left side columns -->
        <div class="col-lg-8 pe-5 mb-4">

            <h1 class="about-right-heading my-4 text-primary"><?= $rows['training']; ?> (<?= $rows['initial']; ?>)</h1>

            <div class="row">
                <img style="height: 400px;" src="../assets/img/training/<?= $rows['image']; ?>" alt="" srcset="">
            </div>
            <div class="my-4 about-details">
                <h4><b>About the training</b></h4>
                <p><?= $rows['about']; ?></p>
            </div>
        </div>

        <!-- Right side columns -->
        <div class="col-lg-4">
            <div class="results">
                <div class="row">
                    <h3 class="mt-4"><b>Target Audience</b></h3>
                    <p><?= $rows['target_audience']; ?></p>
                </div>

                

                <form action="application.php" method="post">
                    <input type="hidden" name="course_id" value="<?= $course_id; ?>">
                    <input type="hidden" name="initial" value="<?= $rows['initial']; ?>">
                    <input type="hidden" name="training" value="<?= $rows['training']; ?>">
                    <input type="hidden" name="duration" value="<?= $rows['duration']; ?>">
                    <input type="hidden" name="start_date" value="<?= $rows['start_date']; ?>">
                    <button type="submit" name="enrole" class="btn btn-primary col-6 my-5 fw-bolder fs-3">APPLY</button>
            </form>

            </div>

        </div>

    </div>
    <!-- ==================End of hero div================== -->





    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>