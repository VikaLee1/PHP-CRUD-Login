<?php
session_start();
require_once 'components/db_connect.php';

if(isset($_SESSION['adm'])){
    header('Location:dashboard.php');
    exit;
}
if(!isset($_SESSION['user'])) {
    header('Location:index.php');
    exit;
}

$query = "SELECT * FROM users WHERE user_id={$_SESSION['user']}";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

$fname = $row['first_name'];
$lname = $row['last_name'];
$dateOfBirth = $row['date_of_birth'];
$email = $row['email'];
$pic = $row['picture'];
$status = $row['status'];


mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome, <?= $fname ?></title>
    <?php require_once 'components/boot.php' ?>
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
  </div>
</nav>
<!-- end of the navbar -->


<!-- hero -->
<header>
        <img class="background-image" src="style/bg.png"></img>
    </header>

    <!-- card -->
    <div class="container py-5 h100">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="pictures/<?= $pic ?>" alt=" avatar" class="rounded-circle img-fluid" style="width: 150px;">
                        <h5 class="my-4">Hi, </h5>
                        <div class="d-flex justify-content-center mb-2">
                            <a class=" btn btn-primary ms-1" href="update.php?id=<?php echo $_SESSION['user'] ?>">Update your profile</a>
                            <a class="btn btn-outline-primary ms-1" href="logout.php?logout">Log Out</a>
                            <a class="btn btn-success ms-1" href="userDashboard.php">Check out our recommendations for you</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card card-body ">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Name</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?= $fname ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Lastname</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?= $lname ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Birthday</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?= $dateOfBirth ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Email</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?= $email ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Status</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?= $status ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>

</html>