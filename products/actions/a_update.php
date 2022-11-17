<?php
require_once "../../components/db_connect.php";
require_once "../../components/file_upload.php";

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../../index.php");
    exit;
}
if (isset($_SESSION['user'])) {
    header("Location: ../../home.php");
    exit;
}

if($_POST) {
    $name=$_POST['name'];
    $author_name=$_POST['author_name'];
    $author_surname=$_POST['author_surname'];
    $type=$_POST['type'];
    $description=$_POST['description'];
    $id=$_POST['id'];
    $picture=file_upload($_FILES['picture']);
    $uploadError='';

    if ($picture->error === 0) {
        ($_POST['image'] == "product.png" ?: unlink("../pictures/$_POST[image]"));
        $sql = "UPDATE media SET title='$name', author_first_name='$author_name',author_last_name='$author_surname', type='$type', short_description='$description', image='$picture->fileName' WHERE media_id = $id";
    } else {
        $sql = "UPDATE media SET title='$name', author_first_name='$author_name',author_last_name='$author_surname', type='$type', short_description='$description' WHERE media_id = $id";
    }
    if (mysqli_query($conn, $sql)) {
        $class = "success";
        $message = "The record was successfully updated";
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    } else {
        $class = "danger";
        $message = "Error while updating record : <br>" . mysqli_connect_error();
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    }
    mysqli_close($conn);
} else {
    header("location: ../error/php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "../components/boot.php"; ?>
    <title>Updating</title>
</head>

<body>
    <div class="container">
        <div class="mt-3 mb-3">
            <h1>Update the recommendation</h1>
        </div>
        <div class="alert alert-<?php echo $class; ?>" role="alert">
            <p><?php echo $message; ?></p>
            <p><?php echo $uploadError; ?></p>
            <a href='../update.php?id=<?= $id ?>'><button class="btn btn-warning" type='button'>Back</button></a>
            <a href='../index.php'><button class="btn btn-success" type='button'>Home</button></a>
        </div>
    </div>

</body>

</html>