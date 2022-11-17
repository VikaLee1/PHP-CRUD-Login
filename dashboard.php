<?php
session_start();
require_once 'components/db_connect.php';

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

if (isset($_SESSION['user'])) {
    header("Location: home.php");
    exit;
}

$sql = "SELECT * FROM users WHERE user_id = {$_SESSION['adm']}";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


$status = 'adm';
$sql = "SELECT * FROM users WHERE status != '$status'";
$result = mysqli_query($conn, $sql);
$tbody = '';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $tbody .= "<tr>
            <td><img class='img-thumbnail rounded-circle' src='pictures/" . $row['picture'] . "' alt=" . $row['first_name'] . "></td>
            <td>" . $row['first_name'] . " " . $row['last_name'] . "</td>
            <td>" . $row['date_of_birth'] . "</td>
            <td>" . $row['email'] . "</td>y
            <td><a href='update.php?id=" . $row['user_id'] . "'><button class='btn btn-primar btn-sm' type='button'>Edit</button></a>
            <a href='delete.php?id=" . $row['user_id'] . "'><button class='btn btn-danger btn-sm' type='button'>Delete</button></a></td>
         </tr>";
    }
} else {
    $tbody = "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

mysqli_close($conn);

?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php require_once 'components/boot.php' ?>
    <title>Welcome, <?= $row['first_name'] ?></title>

</head>

<body>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3 my-4">
                <div class="card-body text-center">
                    <img src="pictures/admavatar.png" alt=" avatar" class="rounded-circle img-fluid" style="width: 150px;">
                    <h5 class="my-4">Administrator</h5>
                    <div class="d-flex justify-content-center mb-2">
                        <a class="btn btn-outline-primary ms-1" href="logout.php?logout">Log Out</a>
                        <a class="btn btn-success ms-1" href="products/index.php">Products</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mt-2">
                <p class='h2'>Users</p>
                <table class='table align-middle mb-0 bg-white'>
                    <thead class='table-light'>
                        <tr>
                            <th>Picture</th>
                            <th>Name</th>
                            <th>Date of birth</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?= $tbody ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>