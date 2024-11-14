<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include 'config.php';

$id = $_GET['id'];
$query = "SELECT * FROM correspondence WHERE id=$id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subject = $_POST['subject'];
    $received_date = $_POST['received_date'];
    $received_by = $_POST['received_by'];
    $file_reference = $_POST['file_reference'];

    $query = "UPDATE correspondence SET subject='$subject', received_date='$received_date', received_by='$received_by', file_reference='$file_reference' WHERE id=$id";
    mysqli_query($conn, $query);

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Edit Record</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" class="form-control" id="subject" name="subject" value="<?php echo $row['subject']; ?>" required>
            </div>
            <div class="form-group">
                <label for="received_date">Received Date:</label>
                <input type="date" class="form-control" id="received_date" name="received_date" value="<?php echo $row['received_date']; ?>" required>
            </div>
            <div class="form-group">
                <label for="received_by">Received By:</label>
                <input type="text" class="form-control" id="received_by" name="received_by" value="<?php echo $row['received_by']; ?>" required>
            </div>
            <div class="form-group">
                <label for="file_reference">File Reference:</label>
                <input type="text" class="form-control" id="file_reference" name="file_reference" value="<?php echo $row['file_reference']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Record</button>
        </form