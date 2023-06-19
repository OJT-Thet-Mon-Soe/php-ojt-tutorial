<?php

    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;

    require("../phpmailer/src/Exception.php");
    require("../phpmailer/src/PHPMailer.php");
    require("../phpmailer/src/SMTP.php");

    require("../database.php");
    session_start();
    if(isset($_SESSION["id"])){
        header("Location: ../index.php");
    }
    $errEmail;
    if(isset($_POST["sendBtn"])){
        $email = $_POST["email"];
        if($email == ""){
        $errEmail = "Email is required.";
        }else{
        $emailData = new AuthData();
        $emailQuery = $emailData->getEmail($email);
        if(mysqli_num_rows($emailQuery) == 0){
            $errEmail = "Email is wrong.Try again!";
        }else{
            $getEmail;
            while($row = mysqli_fetch_assoc($emailQuery)){
            $getEmail = $row["email"];
            }
            $mail = new PHPMailer(true);
            try {
              $mail->isSMTP();
              $mail->Host = 'smtp.gmail.com'; 
              $mail->SMTPAuth   = true;                  
              $mail->Username   = 'thetmomsoe@gmail.com'; 
              $mail->Password   = 'kkobxuecficgobqw'; 
              $mail->SMTPSecure = 'ssl';
              $mail->Port       = 465;  
              
              $mail->setFrom('thetmomsoe@gmail.com');
              $mail->addAddress($getEmail);
              $mail->isHTML(true);
              $mail->Subject = 'Reset Password For Your Gmail';
              $mail->Body    = "http://localhost/php-ojt-tutorials/Tutorial_10/auth/reset_password.php?email=".$getEmail;
              $mail->SMTPDebug = SMTP::DEBUG_SERVER; 
              $mail->send();
              header("Location: ../index.php");

            }catch (Exception $e) {
              echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
            }
          }
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
        Forget Password
      </div>
      <div class="card-body">
        <form method="post">
          <label class="form-label input-label">Email</label>
          <input type="email" name="email" placeholder="Enter email" class="form-control">
          <p class="error-msg">
            <?php
              if(isset($errEmail)){
                echo $errEmail;
              }
            ?>
          </p>
          <div class="forget-btn-box d-flex justify-content-between">
            <a href="login.php" class="text-decoration-none">Login</a>
            <button class="btn btn-primary" type="submit" name="sendBtn">send</button>
          </div>
        </form>
    </div>   
  </div>   
</body>
</html>