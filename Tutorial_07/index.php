<?php
    $images = array();
    $checkFolder = "images/";
    if(is_dir($checkFolder)){
        $scanFolder = scandir($checkFolder);
        for ($i=0; $i <count($scanFolder) ; $i++) { 
            if($scanFolder[$i] != "." && $scanFolder[$i] != ".."){
                $imageFolder = $checkFolder.$scanFolder[$i];
                $imageFile = array($imageFolder,$scanFolder[$i]);
                $imageFile = array("imgSrc"=>$imageFolder,"scanName"=>$scanFolder[$i]);
                array_push($images,$imageFile);
            }
        }
    }
    session_start();

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tutorial 07</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
  <div class="box">
      <h1 class="generate-ttl">QR Code Generator</h1>
      <form method="post" action="generate.php">
          <div class="image-box">
              <label class="form-label">QR Name </label>
              <input type="text" name="qrName" class="form-control" placeholder="Enter QR Name">
              <p class="error-msg">
                <?php
                    if(isset($_SESSION["error"])){
                        echo $_SESSION["error"];
                    }
                ?>
              </p>
          </div>
          <input type="submit" value="Generate" class="generate-btn" name="generate">
      </form>
  </div>

  <div class="generate-box">
    <?php
        if(file_exists("images")){
          if(isset($_SESSION["generateImg"])){
            echo "
            <img src='".$_SESSION["generateImg"]."'>
            <p>".$_SESSION["generateName"]."</p>
            ";
          }
        }
    ?>
  </div>

  <div class="image-gallery">
    <div class="card">
      <div class="card-header">
            <h1 class="qr-ttl">QR Lists</h1>
      </div>
      <div class="card-body">
        <ul>
            <?php
                foreach($images as $image) { 
                    echo "<li>
                            <img src='".$image["imgSrc"]."' class='img-fluid'>
                            <p class='scan-name'>".$image["scanName"]."</p>
                        </li> 
                        ";
                }
            ?>
        </ul>
      </div>
    </div>
  </div>
</body>
</html>