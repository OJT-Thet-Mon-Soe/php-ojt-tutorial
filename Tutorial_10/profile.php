<?php
  require("database.php");
  session_start();
  if(!isset($_SESSION["id"])){
    header("Location: auth/login.php");
    exit();
  } 

  $loginUser = new AuthData();
  $userData = $loginUser->getId($_SESSION["id"]);
  $name;
  $email;
  $image;
  while($row = mysqli_fetch_assoc($userData)){
    $name = $row["name"];
    $email = $row["email"];
    $image = $row["img"];
  }

  $errName;
  $errEmail;
  $errImage;
  if(isset($_POST["updateBtn"])){
    $upName = $_POST["name"];
    $upEmail = $_POST["email"];

    // image
    $upImage = $_FILES["image"];
    $imgName = $upImage['name'];
    $imgType = $upImage['type'];
    $imgTmpName = $upImage['tmp_name'];
    $imgSize = $upImage['size'];
    $fileType = array("jpeg","jpg","png");
    $extension = pathinfo($imgName, PATHINFO_EXTENSION);
    $update;

    if($imgName != ""){
        if(in_array($extension,$fileType) === false){
            $errImage = "Image File extesion must be (JPG,PNG,JPEG)" ;
        }else{
            if($imgSize >= 2097152){
                $errImage = "Image File size must be less than 2000.";
            }else{
                if($upName != "" && $upEmail != ""){
                    unlink("images/".$image);
                    $targetFile = "images/".$imgName;
                    move_uploaded_file($imgTmpName,$targetFile);
                    $updateData = new AuthData();
                    $updateData->getUpdate($_SESSION["id"],$upName,$upEmail,$imgName);
                    header("Location: index.php?success='update'");
                }
            }
        }
    }else{
        $myImg = $image;
        if($upName != "" && $upEmail != ""){
            $updateData = new AuthData();
            $updateData->getUpdate($_SESSION["id"],$upName,$upEmail,$image);
            header("Location: index.php?success='update'");
        }
    }

    if($upName == ""){
        $errName = "Name is required.";
        $name = "";
    }
    if($upEmail == ""){
        $errEmail = "Email is required.";
        $email = "";
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
              <li><a class="dropdown-item" href="#">Profile</a></li>
              <li><a href="auth/logout.php" class="dropdown-item">Logout</a></li>
            </ul>
          </div>
    </div>
  </div>
  <div class="register-box mt-5">
    <div class="card w-25 mx-auto">
      <div class="card-header">
        My Profile Setting
      </div>
      <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            <div class="user-photo">
                <?php
                    if($image == ""){
                    ?>
                        <img src="images/img_default_user.jfif" alt="Default User" class="img-thumbnail" width="80px" height="80px">
                    <?php
                    }else{
                    ?>
                        <img src="images/<?php echo $image; ?>" alt="Default User" class="img-thumbnail" width="80px" height="80px">
                    <?php
                    }
                ?>
            <input type="file" name="image" class="form-control">
            <p class="error-msg">
                <?php
                    if(isset($errImage)){
                        echo $errImage;
                    }
                ?>
            </p>
            </div>
            <label class="form-label input-label">Name</label>
            <input type="text" name="name" placeholder="Enter name" class="form-control" value="<?php echo $name; ?>">
            <p class="error-msg">
                <?php
                    if(isset($errName)){
                        echo $errName;
                    }
                ?>
            </p>
            <label class="form-label input-label">Email</label>
            <input type="email" name="email" placeholder="Enter email" class="form-control" value="<?php echo $email; ?>">
            <p class="error-msg">
                <?php
                    if(isset($errEmail)){
                        echo $errEmail;
                    }
                ?>
            </p>
            
            <button class="btn btn-primary float-end" type="submit" name="updateBtn">update</button>
        </form>
    </div>   
  </div>  
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</html>