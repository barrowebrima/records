<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect to the login page
    header("Location: login.php");
    exit;
}

include 'config.php';

$search = $_GET['search'] ?? '';

$query = "SELECT * FROM correspondence WHERE subject LIKE '%$search%' OR received_by LIKE '%$search%' OR file_reference LIKE '%$search%'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Correspondence Records</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 style="display: inline-block;"> <img src="petcom_logo.png" alt="Snow"  width="80" height="80">Petcom Inward Correspondence Records</h2>
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Search..." value="<?php echo $search; ?>">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Received Date</th>
                    <th>Received By</th>
                    <th>File Reference</th>
                    <th>Timestamp</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['subject']; ?></td>
                    <td><?php echo $row['received_date']; ?></td>
                    <td><?php echo $row['received_by']; ?></td>
                    <td><?php echo $row['file_reference']; ?></td>
                    <td><?php echo $row['timestamp']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="create.php" class="btn btn-success">Add New Record</a>
    </div>
</body>
</html>