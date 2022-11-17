<?php 
session_start();
require_once '../../components/db_connect.php';
require_once '../../components/file_upload.php';

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../../index.php");
    exit;
}
if (isset($_SESSION['user'])) {
    header("Location: ../../home.php");
    exit;
}

if($_POST){
    $name=$_POST['name'];
    $author_name=$_POST['author_name'];
    $author_surname=$_POST['author_surname'];
    $type=$_POST['type'];
    $description=$_POST['description'];
    $picture=file_upload($_FILES['picture']);
    $uploadError='';
    $sql="INSERT into media(title, type, short_description, author_first_name, author_last_name, image) VALUES('$name', '$type', '$description', '$author_name', '$author_surname', '$picture->fileName') ";
    if(mysqli_query($conn,$sql)){
        $class="success";
        $message="The entry below was successfully added to the list<br>
        <table class='table w-50'><tr>
        <td>$name</td>
        <td>written/directed by $author_name  $author_surname</td>
        <td></td>
        </tr></table><hr>";
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    } else {
        $class = "danger";
        $message = "Error while creating record. Try again: <br>" . $conn->error;
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    }
    mysqli_close($conn);
}else {
    header("location: ../error.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creating</title>
    <?php require_once"../components/boot.php" ?>

</head>
<body>
<div class="container">
        <div class="mt-3 mb-3">
            <h1>Create request response</h1>
        </div>
        <div class="alert alert-<?= $class; ?>" role="alert">
            <p><?= $message; ?></p>
            <p><?= $uploadError; ?></p>
            <a href='../index.php'><button class="btn " type='button' style='background:#D0B8A8'>Home</button></a>
        </div>
    </div>
</body>
</html>