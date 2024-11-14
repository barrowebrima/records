<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subject = $_POST['subject'];
    $received_date = $_POST['received_date'];
    $received_by = $_POST['received_by'];
    $file_reference = $_POST['file_reference'];

    $query = "INSERT INTO correspondence (subject, received_date, received_by, file_reference) VALUES ('$subject', '$received_date', '$received_by', '$file_reference')";
    mysqli_query($conn, $query);

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Add New Record</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" class="form-control" id="subject" name="subject" required>
            </div>
            <div class="form-group">
                <label for="received_date">Received Date:</label>
                <input type="date" class="form-control" id="received_date" name="received_date" required>
            </div>
            <div class="form-group">
                <label for="received_by">Received By:</label>
                <input type="text" class="form-control" id="received_by" name="received_by" required>
            </div>
            <div class="form-group">
                <label for="file_reference">File Reference:</label>
                <input type="text" class="form-control" id="file_reference" name="file_reference" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Record</button>
        </form>
    </div>
</body>
</html>