<?php
session_start();
require_once '../../components/db_connect.php';

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../../index.php");
    exit;
}
if (isset($_SESSION['user'])) {
    header("Location: ../../home.php");
    exit;
}

if ($_POST) {
    $id = $_POST['id'];
    $picture = $_POST['picture'];
    ($picture == "product.png" ?: unlink("../pictures/$picture"));
    $sql = "DELETE from media WHERE media_id = $id";
    // echo $sql;
    if (mysqli_query($conn, $sql)) {
        $class = "success";
        $message = "Record deleted";
    } else {
        $class = "danger";
        $message = "Record not deleted" . $conn->error;
    }
    mysqli_close($conn);
} else {
    header("location: ../error.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deleting</title>
    <?php require_once "../../components/boot.php"; ?>
</head>

<body>
    <div class="container">
        <div class="mt-3 mb-3">
            <h1>Delete request response</h1>
        </div>
        <div class="alert alert-<?= $class; ?>" role="alert">
            <p><?= $message; ?></p>
            <a href='../index.php'><button class="btn btn-success" type='button'>Home</button></a>
        </div>
    </div>
</body>

</html>