<?php 
require_once "../components/db_connect.php";

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
        $isbn_code=$data['isbn_code'];
        $publisher_name=$data['publisher_name'];
        $publisher_address=$data['publisher_adress'];
        $publisher_date=$data['publish_date'];
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
    <title>Details</title>
    <?php require_once "../components/boot.php" ?> 

    <style type="text/css">
    fieldset {
        margin: auto;
        margin-top: 150px;
        width: 60%;
    }

    .img-thumbnail {
        width: 70px !important;
        height: 70px !important;}

        .background-image {
    position: absolute;
    top: 0;
    left: 0;
    z-index: -1;
    width: 100%;
    height: 350px;
    object-fit: cover;
    filter: brightness(50%);
}

header {
    height: 150px;
    margin-bottom: 100px;
    display: grid;
    place-items: center;
}

h1 {
    color: white;
    font-size: 60px;
    line-height: 1.1;
    font-weight: inherit;
    letter-spacing: normal;
    margin-top: 70px;
    margin-bottom: 30px;
}

    </style>
</head>
<body>
<!-- navbar from bootstrap -->
<nav class="navbar navbar-expand-lg bg-dark">
  <div class="container-fluid ">
    <a class="navbar-brand text-white" href="">Big Library</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-white ">
        <li class="nav-item">
          <a class="nav-link text-white " href="index.php">Our recommendation</a>
        </li>  
      </ul>  
    </div>
  </div>
</nav>
<!-- end of the navbar -->

<!-- hero section -->
    <header>
        <img class="background-image" src="../style/bg.png"></img>
        <h1><?php echo $name ?></h1>
        <h5 class="text-white">by <?php echo $author_name ?>  <?php echo $author_surname ?></h5>
    </header>



    <!-- details about each item -->
<fieldset>
<div class="card mb-3 rounded border-0" style='max-width: 900px;'>
  <img src="../pictures/<?= $picture ?>" class="card-img-top img-fluid rounded" alt=".pictures/<?=$name?>" >
  <div class="card-body">
    <h5 class="card-title text-center"><?php echo $name ?></h5>
    <p class="card-text small">written/directed by <?php echo $author_name ?> <?php echo $author_surname ?></p>
    <p class="card-text"><?php echo $description ?></p>
    
    <p class="card-text"><small class="text-muted">Published by <?php echo $publisher_name ?> (<?php echo $publisher_address ?>) in year <?php echo $publisher_date ?>.</small></p>
    <p class="card-text"><small class="text-muted">The ISBN code:<?php echo $isbn_code ?> </small></p>

  <p class='card-text'><small class='text-muted'><a href='index.php'><button class='btn text-white btn-sm' type='button' style='background:#D0B8A8'  >Go back</button></a></small></p>
</div>
</div>
</fieldset>

</body>
</html>