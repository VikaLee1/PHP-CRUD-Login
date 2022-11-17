<?php 
require_once "../components/db_connect.php";

session_start();
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}
if (isset($_SESSION['user'])) {
    header("Location: ../home.php");
    exit;
}

if($_GET['id']){
    $id=$_GET['id'];
    $sql= "SELECT *FROM media WHERE media_id=$id";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) ==1){
        $data = mysqli_fetch_assoc($result);
        $name=$data['title'];
        $author_name=$data['author_first_name'];
        $author_surname=$data['author_last_name'];
        $type=$data['type'];
        $description=$data['short_description'];
        $picture=$data['image'];

    }
} else {
    header("location: error.php");
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Updating</title>
    <?php require_once "../components/boot.php"; ?>
    <style type="text/css">
    fieldset {
        margin: auto;
        margin-top: 100px;
        width: 60%;
    }

    .img-thumbnail {
        width: 70px !important;
        height: 70px !important;
    }
    </style>

</head>

<body>
    <fieldset>
        <legend class='h2'>Update the recommendation <img class='img-thumbnail rounded-circle' src='./pictures/<?= $picture ?>'
                alt=""></legend>
         <form action="actions/a_update.php" method= "post" enctype="multipart/form-data">
                <table class='table'>
                    <tr>
                        <th>Name</th>
                        <td>
                            <input class='form-control' type="text" name="name" value="<?= $name?>" />
                        </td>
                    </tr>   
                    <tr>
                        <th>Author name or name of Director</th>
                        <td>
                            <input class='form-control' type="text" name="author_name" value="<?= $author_name?>" />
                        </td>
                    </tr>    
                    <tr>
                        <th>Surname of an author or director</th>
                        <td>
                            <input class='form-control' type="text" name="author_surname" value="<?= $author_surname?>"  />
                        </td>
                    </tr>     
                     <tr>
                        <th>Short description</th>
                        <td>
                        <!-- <textarea type="text"  rows="5"  cols="30" class='form-control' placeholder="no more than 255 characters" maxlength="255">
                        
                        </textarea> -->
                        
                        <input class='form-control' type="text" name="description"  value="<?= $description?>" />
                        </td>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <td><select name="type" class='form-control' type="text" value="<?= $type?>">
                            <option value="book" name="Book">Book</option>
                            <option value="dvd" name="CD">DVD</option>
                            <option value="cd" name="DVD">Audio-book</option>
                        </select></td>
                    </tr>
                    <tr>
                        <th>Picture<p class='card-text'><small class='text-muted'>A picture may be added later</small></p></th>
                        <td><input class='form-control' type="file" name="picture" /></td>
                        
                    </tr>
                    <tr>
                    <input type="hidden" name="id" value="<?= $id ?>" />

                    <input type="hidden" name="picture" value="<?= $picture ?>" />
                    <td><button class="btn btn-success" type="submit">Save Changes</button></td>
                    <td><a href="index.php"><button class="btn btn-warning" type="button">Back</button></a></td>
                </tr>
                </table>
            </form>
    </fieldset>
</body>

</html>