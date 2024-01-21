<?php

$conn = mysqli_connect('localhost', 'root', '', 'pasi');
if(isset($_POST['submit'])){
    $initial = $_POST['initial'];
    $date = $_POST['date'];
    $location = $_POST['location'];
    $fees = $_POST['fees'];

    $stmt = "INSERT INTO `dates` (`initial`, `date`, `location`, `fees`) VALUES
    ('$initial', '$date', '$location', '$fees')";

    $stmt_run = mysqli_query($conn, $stmt);
    if ($stmt_run) {
        echo "Date added successfully";
    }else{
        echo "Error while adding the date";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Enter date details</h1>

    <form action="insert-date.php" method="post">
        <div style="margin-top: 10px;">
            <font size="5"><label>Initial</label></font>
            <input style="height: 30px;" type="text" name="initial">
        </div>

        <div style="margin-top: 10px;">
            <font size="5"><label>Date</label></font>
            <input style="height: 30px;" type="text" name="date">
        </div>

        <div style="margin-top: 10px;">
            <font size="5"><label>Location</label></font>
            <input style="height: 30px;" type="text" name="location">
        </div>
        <div style="margin-top: 10px;">
            <font size="5"><label>Fees</label></font>
            <input style="height: 30px;" type="text" name="fees">
        </div>

        <div style="margin-top: 10px;">
            <input style="height: 30px;" type="submit" name="submit">
        </div>
    </form>
</body>

</html>