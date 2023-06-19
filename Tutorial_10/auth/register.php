<?php
    session_start();
    if(isset($_SESSION["id"])){
        header("Location: ../index.php");
    }
    require("../database.php");
    if(isset($_POST["registerBtn"])){
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $password = $_POST["password"];
        $address = $_POST["address"];
        $validatePassword;
        $validateEmail;
        $errName;
        $errPhone;
        $errAddress;
        $errPassword;
        $errEmail;
        if($name == ""){
            $errName = "Name is required";
        }
        if($phone == ""){
            $errPhone = "Phone Number is required";
        }elseif(substr($phone, 0, 2) != "09"){
            $errPhone = "Phone Number must start with 09.";
        }else{
            if(strlen($phone)<11 || strlen($phone)>11){
                $errPhone = "Phone Number must be 11 numbers.";
            }
        }
        if($address == ""){
            $errAddress = "Password is required";
        }
        if($password == ""){
            $errPassword = "Password is required.";
        }elseif(strlen($password)<8){
            $errPassword = "Password must be minimum 8 characters.";
        }elseif(strlen($password)>15){
            $errPassword = "Password must be maximum 15 characters.";
        }else{
        if(!preg_match('@[^\w]@',$password)){
            $errPassword = "Password must have( A-Z),(a-z),(0-9),(#$@&^%!*)";
        }elseif(!preg_match('@[A-Z]@',$password)){
            $errPassword = "Password must have( A-Z),(a-z),(0-9),(#$@&^%!*)";
        }elseif(!preg_match('@[a-z]@',$password)){
            $errPassword = "Password must have( A-Z),(a-z),(0-9),(#$@&^%!*)";
        }elseif(!preg_match('@[0-9]@',$password)){
            $errPassword = "Password must have( A-Z),(a-z),(0-9),(#$@&^%!*)";
        }else{
            $validatePassword = $password;
        }
        }

        if($email != ""){
            $emailData = new AuthData();
            $emailQuery = $emailData->getEmail($email);
        if(mysqli_num_rows($emailQuery) != 0){
            $errEmail = "Email is already registered.";
        }else{
            $validateEmail = $email;
        }
        }else{
        $errEmail = "Email is required.";
        }

        if($name != "" && !empty($validateEmail) && $phone != "" && !empty($validatePassword) && $address != ""){
            $register = new AuthData();
            $register->getData($name,$validateEmail,$phone,$validatePassword,$address);
            header("Location: login.php");
            exist();
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
<div class="register-box mt-5">
    <div class="card w-25 mx-auto">
      <div class="card-header">
        Register
      </div>
      <div class="card-body">
        <form method="post">
          <label class="form-label input-label">Name</label>
          <input type="text" name="name" placeholder="Enter name" class="form-control" value="<?php if(isset($name)){echo $name;} ?>">
          <p class="error-msg">
            <?php
              if(isset($errName)){
                echo $errName;
              }
            ?>
          </p>
          <label class="form-label input-label">Email</label>
          <input type="email" name="email" placeholder="Enter email" class="form-control" value="<?php if(isset($name)){echo $email;} ?>">
          <p class="error-msg">
            <?php
                if(isset($errEmail)){
                  echo $errEmail;
                }
            ?>
          </p>
          <label class="form-label input-label">Phone</label>
          <input type="tel" name="phone" placeholder="Enter phone number" class="form-control" value="<?php if(isset($phone)){echo $phone;} ?>">
          <p class="error-msg">
          <?php
              if(isset($errPhone)){
                echo $errPhone;
              }
            ?>
          </p>
          <label class="form-label input-label">Password</label>
          <input type="password" name="password" placeholder="Enter password" class="form-control">
          <p class="error-msg">
          <?php
              if(isset($errPassword)){
                echo $errPassword;
              }
            ?>
          </p>
          <label class="form-label input-label">Address</label>
          <input type="text" name="address" class="form-control" placeholder="Enter address" value="<?php if(isset($address)){echo $address;} ?>"></input>
          <p class="error-msg">
            <?php
                if(isset($errAddress)){
                  echo $errAddress;
                }
              ?>
          </p>
          <button class="btn btn-primary w-100" type="submit" name="registerBtn">Register</button>
          <p class="text-center mt-3"><a href="login.php" class="already">Already have an account?</a></p>
        </form>
    </div>   
  </div>   
</body>
</html>