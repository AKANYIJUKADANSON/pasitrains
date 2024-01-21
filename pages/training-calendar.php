<?php
session_unset();
session_start();
// error_reporting(0);  
include('../inc/config.php');

$getTrainings = "SELECT * FROM training_calendar";
$getTrainings_query = mysqli_query($conn, $getTrainings);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Training Calender</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/img/favicon/favicon-16x16.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="../assets/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <?php include('../inc/navbar.php'); ?>

    <div class="m-4">
        <div class="">

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
            unset($_SESSION['status']);
            unset($_SESSION['color']);
            ?>

            <h3 class="mt-4">Training Calender 2023/2024</h3>
            <hr style="height: 3px; background-color:orangered">
        </div>
        <div class="row mx-1">
            <?php while ($trainings = mysqli_fetch_assoc($getTrainings_query)) {
                $trainCode = 'TR_0' . $trainings['code'];
            ?>
                <div class="col-md-4 mt-4">
                    <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5), 0 6px 20px 0 rgba(0, 0, 0, 0.4);">
                        <img style="height: 350px; width: 100%" src="../assets/img/training/<?= $trainings['image']; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-subtitle mb-2 text-primary"><?= $trainings['training']; ?> <b>(<?= $trainings['initial']; ?>)</b></h5>
                            <div class="row mt-4">
                                <div class="col-lg-12 col-md-12 label "><i class="bi bi-clock-fill text-danger me-2"></i><b class="me-4">Duration:</b><b class="text-secondary"><?= $trainings['duration']; ?></b></div>
                            </div>

                            <form action="course-details.php" method="post">
                                <input type="hidden" name="course_id" value="<?= $trainings['code']; ?>">

                                <input type="hidden" name="course_initial" value="<?= $trainings['initial']; ?>">
                                <button type="submit" name="more_details" class="btn btn-primary mt-4">More</button>
                            </form>

                        </div>


                    </div>
                </div>

            <?php } ?>
            <!-- </div> -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>