<?php
  require("../database.php");
  session_start();
  if(isset($_SESSION["id"])){
      header("Location: ../index.php");
  }
  if(isset($_GET["email"])){
    $getEmail = $_GET["email"];
  }

  $errEmail;
  $errPassword;
  $errConPassword;
  if(isset($_POST["confirmBtn"])){
    $dataEmail = $_POST["email"];
    $newPassword = $_POST["newPassword"];
    $confirmPassword = $_POST["confirmPassword"];
    $validateNewPassword;
    $validateConPassword;
    $validateEmail;

    if($dataEmail == ""){
      $errEmail = "Email is required.";
      $getEmail = "";
    }else{
      $emailData = new AuthData();
      $emailQuery = $emailData->getEmail($dataEmail);
      if(mysqli_num_rows($emailQuery) == 0){
        $errEmail = "Email is wrong.Try again!";
        $getEmail = $email;
      }else{
        $validateEmail = $dataEmail;
      }
    }

    if($newPassword == ""){
      $errPassword = "New Password is required.";
      }elseif(strlen($newPassword)<8){
      $errPassword = "Password must be minimum 8 characters.";
      }elseif(strlen($newPassword)>15){
      $errPassword = "Password must be maximum 15 characters.";
      }else{
      if(!preg_match('@[^\w]@',$newPassword)){
          $errPassword = "Password must have( A-Z),(a-z),(0-9)";
      }elseif(!preg_match('@[A-Z]@',$newPassword)){
          $errPassword = "Password must have( A-Z),(a-z),(0-9)";
      }elseif(!preg_match('@[a-z]@',$newPassword)){
          $errPassword = "Password must have( A-Z),(a-z),(0-9)";
      }elseif(!preg_match('@[0-9]@',$newPassword)){
          $errPassword = "Password must have( A-Z),(a-z),(0-9)";
      }else{
          $validateNewPassword = $newPassword;
      }
    }
    if($confirmPassword == ""){
      $errConPassword = "Confirm Password is required.";
    }else{
      if(isset($validateNewPassword)){
        if($confirmPassword != $validateNewPassword){
          $errConPassword = "Confirm Password isn't same with new password.";
        }else{
          $validateConPassword = $confirmPassword;
        }
      }
    }

    if(isset($validateEmail) && isset($validateNewPassword) && isset($validateConPassword)){
      $resetPassword = new AuthData();
      $resetPassword->updatePassword($validateEmail,$validateNewPassword);
      header("Location: login.php");
    }
  }
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
<div class="register-box mt-5">
    <div class="card w-25 mx-auto">
      <div class="card-header">
        Reset Password
      </div>
      <div class="card-body">
        <form method="post">
          <label class="form-label input-label">Email</label>
          <input type="email" name="email" placeholder="Enter email" class="form-control" value="<?php echo $getEmail; ?>">
          <p class="error-msg">
            <?php
              if(isset($errEmail)){
                echo $errEmail;
              }
            ?>
          </p>
          <label class="form-label input-label">New Password</label>
          <input type="password" name="newPassword" placeholder="Enter New Password" class="form-control" value="">
          <p class="error-msg">
            <?php 
              if(isset($errPassword)){
                echo $errPassword;
              }
            ?>
          </p>
          <label class="form-label input-label">Confirm Password</label>
          <input type="password" name="confirmPassword" placeholder="Enter Confirm Password" class="form-control" value="">
          <p class="error-msg">
            <?php
                if(isset($errConPassword)){
                  echo $errConPassword;
                }
            ?>
          </p>
          <div class="forget-btn-box d-flex justify-content-between">
            <a href="login.php" class="text-decoration-none">Login</a>
            <button class="btn btn-primary" type="submit" name="confirmBtn">Confirm</button>
          </div>
        </form>
    </div>   
  </div>   
</body>
</html>