<?php 
session_start();
require_once '../components/db_connect.php';

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

if (isset($_SESSION['user'])) {
    header("Location: home.php");
    exit;
}


$sql="SELECT * from media";
$result=mysqli_query($conn,$sql);
$tbody="";

if (mysqli_num_rows($result)>0) {
    while($row=mysqli_fetch_assoc($result)) {
        $tbody .= "
        <div class='card mb-3 border-0' style='max-width: 540px;'>
  <div class='row g-0'>
        <div class='col-md-4'>
      <img src='../pictures/".$row['image']."' class='img-fluid rounded-start' alt=''>
    </div>
    <div class='col-md-8'>
      <div class='card-body'>
        <h5 class='card-title'>" .$row['title']. "</h5>
        <p class='card-text'><small class='text-muted'>".$row['type']." written/directed by ".$row['author_first_name']." ".$row['author_last_name']." </small></p>
        <p class='card-text'>".$row['short_description']."</p>
        <p class='card-text'><small class='text-muted'><a href='details.php?id=". $row['media_id'] ."'><button class='btn text-white btn-sm' type='button' style='background:#D0B8A8'  >Read more</button></a></small></p>
        
        <a href='update.php?id=" . $row['media_id'] . "'><button class='btn text-white btn-sm' type='button' style='background:#7D6E83' >Edit</button></a>
        <a href='delete.php?id=" . $row['media_id'] . "'><button class='btn btn-danger btn-sm' type='button'>Delete</button></a></td>
      </div>
    
    </div>  <hr>
    </div>
    </div>
        ";
    } 
}else {
        $tbody="<tr><td colspan='4' class='text-center'>Be the first to add a recommendation</td></tr>";
    }

    mysqli_close($conn);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Big Library</title>
   
    <?php require_once "../components/boot.php" ?> 
    <!-- <link rel="stylesheet" href="../style/"> -->
    <style>
            .card {
                margin: auto;
                margin-top: 10px;
                width: 60% ;
            }      
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
h2 {
  color: white;
}

.navbar-toggler-icon {
    color: white !important;
}

a:hover{
  transform: scale(1.1);

}

/* style for the footer */
.container {
    color: white;
}

ul,
li {
    margin: 0px;
    padding: 0px;
    list-style: none;
}

.social_icon {
  
    width: 100%;
    margin: 0 auto;
    text-align: center;
    padding-top: 10px;
}

.hoverIcon:hover {
    transform: scale(1.2);
}

.social_icon ul {
    margin: 0px;
    padding: 0px;
    display: inline-flex;
}

.copyright_section {
    width: 100%;
    float: left;
    background-color: black;
    height: auto;
}

.copyright_text {
    width: 100%;
    float: left;
    color: #000;
    text-align: center;
    font-size: 16px;
    margin-left: 0px;
}

        </style>
</head>
<body>

<!-- navbar from bootstrap -->
<nav class="navbar navbar-expand-lg">
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
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-white ">
        <li class="nav-item">
        <a class="nav-link text-white " href="../logout.php?logout">Log Out</a>
         
        </li>  
      </ul>  
    </div>
    
  </div>
</nav>
<!-- end of the navbar -->


<!-- hero -->
<header>
        <img class="background-image" src="../style/bg.png"></img>
        <h1>Cozy up this fall</h1>
        <h2 class="card-title ">Recommendations from our readers</h2>
    </header>


<div class='mb-3 sticky-top'>
            <a href="create.php"><button class='btn text-white'  style="background:#815B5B"  type="button">Add your recommendation</button></a>
        </div>
    
<!-- card from bootstrap -->
            <tbody>
                <?php echo $tbody; ?> 
            </tbody>
  

<!-- footer -->
<div class="copyright_section">
    <div class="container">
        <div class="social_icon justify-content-between">
            <ul>
                <li class="hoverIcon">
                    <a href="https://github.com/VikaLee1/BE17-CR-Viktoria"><i class="fa-brands fa-github text-white"></i></a>
                </li>
                <span>&nbsp;&nbsp;</span>
            </ul>
        </div>
        <p class="copyright_text text-white">
            <p class="text-center">2022 - Code Review 4 - Viktoria</p>
    </div>

</body>
</html>