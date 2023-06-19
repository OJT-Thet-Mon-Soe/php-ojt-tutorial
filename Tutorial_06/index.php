<?php
    $displayData = array();
    $subFolderCheck = array();
    $folderCheck = "images/";
    if(is_dir($folderCheck)){
        $scanFolder = scandir($folderCheck);
        for ($i=0; $i < count($scanFolder); $i++) { 
            if($scanFolder[$i] != "." && $scanFolder[$i] != ".."){
                $data = "images/".$scanFolder[$i]."/";
                array_push($subFolderCheck,$data);
            }
        }
    }

    for ($k=0; $k < count($subFolderCheck); $k++) { 
        $folderName = $subFolderCheck[$k];
        if(is_dir($folderName)){
            $scanFile = scandir($folderName);
            for ($m=0; $m < count($scanFile); $m++) {
                if($scanFile[$m] != "." && $scanFile[$m] != ".."){
                    $imgSrc = $folderName.$scanFile[$m];
                    $currentUrl = "http://localhost/php-ojt-tutorials/Tutorial_06/".$folderName.$scanFile[$m];
                    $myData = array("name"=>$scanFile[$m],"src"=>$imgSrc,"url"=>$currentUrl);
                    array_push($displayData,$myData);
                }
            }
        }
    }

    if(isset($_GET["path"])){
        unlink($_GET["path"]);
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tutorial-6</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <?php
        if (isset($_GET["upload"])) {
            if($_GET["upload"] == "success"){
                ?>
                <div class="alert alert-primary" role="alert">
                    Upload Image Successfully !
                </div>
                <?php
            }
        }
    ?>
    <div class="box">
    <h1 class="upload-ttl">Upload Image</h1>
    <form method="post" action="upload.php" enctype="multipart/form-data">
        <div class="image-box">
            <label class="form-label">Folder Name : </label>
            <input type="text" name="folderName" value="<?php if(isset($_GET["oldValue"])){echo $_GET["oldValue"];} ?>" class="form-control" placeholder="Enter Folder Name">
            <p class="error-msg">
                <?php
                    if(isset($_GET["folderVali"])){
                        echo $_GET["folderVali"];
                    }
                ?>
            </p>
            <label class="form-label">Choose image</label>
            <input type="file" class="form-control" name="image">
            <p class="error-msg">
                <?php
                    if(isset($_GET["imageVali"])){
                        echo $_GET["imageVali"];
                    }
                ?>
            </p>
        </div>
        <input type="submit" value="Upload" class="upload-btn" name="upload">
    </form>
    </div>

    <div class="image-gallery">
    <div class="card">
        <ul>
        <?php
            foreach($displayData as $result){
                echo "
                    <li>
                        <img src=".$result['src']." class='img-fluid'>
                        <div class='img-detail-box'>
                        <p class='text-primary'>".$result['name']."</p>
                        <p class='text-primary'>".$result['url']."</p>
                        <a onClick=\"javascript: return confirm('Please confirm deletion');\"  href='index.php?path=".$result['src']."' class='text-white btn btn-danger'>Delete</a>
                        </div>
                    </li>
                ";
            }
        ?>
        </ul>
    </div>
    </div>
</body>
</html>

    

    