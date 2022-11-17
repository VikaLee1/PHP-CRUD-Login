<?php
session_start();

if (isset($_SESSION['user'])) {
    header("Location: home.php");
    exit;
}

if (isset($_SESSION['adm'])) {
    header("Location: dashboard.php");
    exit;
}
require_once 'components/db_connect.php';

$error = false;
$email = $pass = $emailError = $passError = "";

if (isset($_POST['btn-login'])) {
    // prevent sql injections/ clear user invalid inputs
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);

    if (empty($email)) {
        $error = true;
        $emailError = "Please enter your email address.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address.";
    }
    if (empty($pass)) {
        $error = true;
        $passError = "Please enter your password.";
    }

    if (!$error) {
        $password = hash('sha256', $pass);
        $sql = "SELECT * FROM USERS WHERE email= '$email' AND password = '$password'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $count = mysqli_num_rows($result);

        if ($count == 1) {
            if ($row['status'] == "adm") {
                $_SESSION['adm'] = $row['user_id'];
                header("Location: dashboard.php");
                exit;
            } else {
                $_SESSION['user'] = $row['user_id'];
                header("Location: home.php");
                exit;
            }
        } else {
            $errMSG = "Incorrect Credentials, Try again...";
        }
    }
}
mysqli_close($conn);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <?php require_once "components/boot.php" ?> 
    <style>
    .background-image {
    position: absolute;
    top: 0;
    left: 0;
    z-index: -1;
    width: 100%;
    height: 250px;
    object-fit: cover;
    filter: brightness(70%);
}

header {
    height: 120px;
    margin-bottom: 80px;
    display: grid;
    place-items: center;
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

.footer{
    margin-top: 270px;
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
      <!-- <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-white ">
        <li class="nav-item">
          <a class="nav-link text-white " href="index.php">Our recommendation</a>
        </li>  
      </ul>   -->
    </div>
  </div>
</nav>
<!-- end of the navbar -->


  <!-- Section: Design Block -->
<section class="text-center">
<!-- hero -->
<header>
        <img class="background-image" src="style/bg.png"></img>
        <!-- <h1>text over the image</h1> -->
     </header>



  <div class="card mx-4 mx-md-5 shadow-5-strong" style="
        margin-top: -100px;
        background: hsla(0, 0%, 100%, 0.8);
        backdrop-filter: blur(30px);
        ">
    <div class="card-body py-5 px-md-5">

      <div class="row d-flex justify-content-center">
        <div class="col-lg-8">
          <h2 class="fw-bold mb-3">Log in</h2>
         
          <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" enctype="multipart/form-data" >
          <?php
          if (isset($errMSG)) {
              echo $errMSG;
          }
          ?>

            <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="email" id="form3Example3"  name="email" class="form-control" value="<?php echo $email ?>"/>
              <label class="form-label" for="form3Example3">Email address</label>
              <span class="text-danger"> <?php echo $emailError; ?> </span>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
              <!-- <input type="password" id="form3Example4" name="pass" class="form-control" /> -->
              <input type="password" name="pass" class="form-control" maxlength="15" />

              <label class="form-label" for="form3Example4">Password</label>
              <span class="text-danger"> <?php echo $passError; ?> </span>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4"  name="btn-login">
              Log in
            </button>
            <div class="form-outline">
              <small>Don't have an account?<a href="register.php">Register</a></small>
            </div>
            
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Section: Design Block -->  


<!-- footer -->
<div class="footer">
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
            <p class="text-center">2022 - Viktoria</p>
    </div>

</body>
</html>