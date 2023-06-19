<?php
  require("database.php");
  session_start();
  $userId;
  if(isset($_SESSION["id"])){
    $userId = $_SESSION["id"];

    $loginUser = new AuthData();
    $userData = $loginUser->getId($userId);
    $image;
    while($row = mysqli_fetch_assoc($userData)){
      $image = $row["img"];
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tutorial 10</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
  <div class="bg-secondary">
    <div class="w-75 mx-auto py-3 d-flex justify-content-between align-items-center">
      <h1 class="text-white">Welcome</h1>
      <?php
        if(isset($userId)){
          ?>
          <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?php
                if($image == ""){
                  ?>
                  <img src="images/img_default_user.jfif" alt="Default User" class="nav-img" width="50px" height="50px">
                  <?php
                }else{
                  ?>
                  <img src="images/<?php echo $image; ?>" alt="Default User" class="nav-img" width="50px" height="50px">
                  <?php
                }
              ?>
            </a>

            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="profile.php">Profile</a></li>
              <li><a href="auth/logout.php" class="dropdown-item">Logout</a></li>
            </ul>
          </div>
          <?php
        }else{
          ?>
          <div>
            <a href="auth/login.php" class="btn btn-primary">Login</a>
            <a href="auth/register.php" class="btn btn-primary">Register</a>
          </div>
          <?php
        }
      ?>
    </div>
  </div>
  <?php
    if(isset($_GET["success"])){
      ?>
      <div class="alert alert-success alert-dismissible fade show w-25 m-3 ms-auto" role="alert">
        Profile successfully update !
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php
    }
  ?>
  <h1 class="welcome-txt">Welcome From My Website</h1>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</html>