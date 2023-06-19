<?php

    session_start();
    if(isset($_SESSION["id"])){
        header("Location: ../index.php");
    }
    require("../database.php");
    if(isset($_POST["loginBtn"])){
        $email = $_POST["email"];
        $password = $_POST["password"];
        $errEmail;
        $errPassword;
        if($email == ""){
          $errEmail = "Email is required.";
        }else{
          $emailData = new AuthData();
          $emailQuery = $emailData->getEmail($email);
          if(mysqli_num_rows($emailQuery) == 0){
            $errEmail = "Email is wrong.Try again!";
          }else{
            $passwordData = new AuthData();
            $passwordQuery = $passwordData->getPassword($email);
            while($row = mysqli_fetch_assoc($passwordQuery)){
              if($row["password"] == $password){
                $_SESSION["id"] = $row["id"];
                header("Location: ../index.php");
              }else{
                $errPassword = "Password is wrong.Try again!";
              }
            }
          }
        }
        if($password == ""){
          $errPassword = "Password is required.";
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
        Login
      </div>
      <div class="card-body">
        <form method="post">
          <label class="form-label input-label">Email</label>
          <input type="email" name="email" placeholder="Enter email" class="form-control" value="<?php if(isset($email)){echo $email;} ?>">
          <p class="error-msg">
            <?php
              if(isset($errEmail)){
                echo $errEmail;
              }
            ?>
          </p>
          <label class="form-label input-label">Password</label>
          <input type="password" name="password" placeholder="Enter password" class="form-control" value="">
          <a href="forget_password.php" class="forger-pw">forget password?</a>
          <p class="error-msg">
            <?php
                if(isset($errPassword)){
                  echo $errPassword;
                }
              ?>
          </p>
          
          <button class="btn btn-primary w-100" type="submit" name="loginBtn">Login</button>
          <p class="text-center mt-3"><span class="not-member">Not a member? </span><span><a href="register.php" class="sign-up">Sign Up</a></span></p>
        </form>
    </div>   
  </div>   
</body>
</html>