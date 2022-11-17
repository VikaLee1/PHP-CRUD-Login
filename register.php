<?php 

session_start();
if(isset($_SESSION['user'])) {
    header("Location: home.php");
    exit;
}

if(isset($_SESSION['adm'])) {
    header("Location: dashboard.php");
    exit;
}
require_once 'components/db_connect.php';
require_once 'components/file_upload.php';

$error=false;

$fname=$lname=$date_of_birth=$email=$pass=$picture="";
$fnameError=$fnameError=$dateError=$emailError=$passError=$picError="";

if(isset($_POST['btn-signup'])) {
    // to cut space before and after the text
    $fname =trim($_POST['fname']);
     // prevent inserting code into the system
    $fname=strip_tags($fname);
    $fname=htmlspecialchars($fname);

    $lname =trim($_POST['lname']);
    $lname=strip_tags($lname);
    $lname=htmlspecialchars($lname);

    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $date_of_birth = trim($_POST['date_of_birth']);
    $date_of_birth = strip_tags($date_of_birth);
    $date_of_birth = htmlspecialchars($date_of_birth);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);

    $uploadError = "";
    $picture = file_upload($_FILES['picture']);


    if (empty($fname) || empty($lname)) {
        $error = true;
        $fnameError = "Please enter your name and surname";
    } elseif (strlen($fname) < 3 || strlen($lname) < 3) {
        $error = true;
        $fnameError = "Name and surname must have at least 3 characters";
    } elseif (!preg_match("/^[a-zA-z]+$/", $fname) || !preg_match("/^[a-zA-z]+$/", $lname)) {
        $error = true;
        $fname = "Name and surname must contain only letters and no spaces";
    }

    if (empty($date_of_birth)) {
        $error = true;
        $dateError = "Please enter your date of birth";
    }



    if (empty($email)) {
        $error = true;
        $emailError = "Please enter your email";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address";
    } else {
        $query = "SELECT email FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $query);
        $count = mysqli_num_rows($result);
        if ($count != 0) {
            $error = true;
            $emailError = "Provided email already exists";
        }
    }

    if (empty($pass)) {
        $error = true;
        $passError = "Please enter the password";
    } elseif (strlen($pass) < 6) {
        $error = true;
        $passError = "Password must have at least 6 characters";
    }

    $password = hash('sha256', $pass);

    if (!$error) {
        $query = "INSERT INTO users(first_name, last_name, password, date_of_birth,email, picture) 
        VALUES ('$fname', '$lname','$password','$date_of_birth', '$email', '$picture->fileName')";
        $res = mysqli_query($conn, $query);

        if ($res) {
            $errTyp = "success";
            $errMSG = "Successfully registered, you may login now";
            $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
        } else {
            $errTyp = "danger";
            $errMSG = "Something went wrong, try again later...";
            $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
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
    <title>Registration form</title>
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
    margin-top: 30px;
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
          <h2 class="fw-bold mb-3">Registration Form</h2>
          <div class="text-center mb-3">
         <img src="" width=200px height=200px class="rounded" alt="..." type="file" name="picture">  
            <span class="text-danger"> <?php echo $picError; ?> </span>
</div>
          <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" enctype="multipart/form-data" >
          <?php
                            if (isset($errMSG)) {
                            ?>
                                <div class="alert alert-<?php echo $errTyp ?>">
                                    <p><?php echo $errMSG; ?></p>
                                    <p><?php echo $uploadError; ?></p>
                                </div>
                            <?php
                            }
                            ?>
            <!-- 2 column grid layout with text inputs for the first and last names -->
            <div class="row">
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <input type="text" id="form3Example1" name="fname" class="form-control" />
                  <label class="form-label" for="form3Example1">First name</label>
                  <span class="text-danger"> <?php echo $fnameError; ?> </span>
                </div>
              </div>
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <input type="text" id="form3Example2" name="lname" class="form-control" />
                  <label class="form-label" for="form3Example2">Last name</label>
                  <span class="text-danger"> <?php echo $fnameError; ?> </span>
                </div>
              </div>
            </div>
            <!-- Birthday input -->
            <div class="form-outline mb-4">
            <input class='form-control' type="date" name="date_of_birth" value="<?php echo $date_of_birth ?>" />
              <label class="form-label" for="birthday" name="date_of_birth">Birthday</label>
              <span class="text-danger"> <?php echo $dateError; ?> </span>
            </div>
            <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="email" id="form3Example3"  name="email" class="form-control" />
              <label class="form-label" for="form3Example3">Email address</label>
              <span class="text-danger"> <?php echo $emailError; ?> </span>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
              <input type="password" id="form3Example4" name="pass" class="form-control" />
              <label class="form-label" for="form3Example4">Password</label>
              <span class="text-danger"> <?php echo $passError; ?> </span>
            </div>

            <!-- upload a picture -->
            <div class="form-outline mb-4">
              <input class='form-control' type="file" name="picture">
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4" name="btn-signup">
              Register
            </button>
            <div class="form-outline">
              <small><a href="index.php">log in </a> if you have an account</small>
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