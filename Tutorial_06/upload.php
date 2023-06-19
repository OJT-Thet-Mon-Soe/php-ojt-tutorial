<?php
    if(isset($_POST["upload"])){
        $folderName = $_POST["folderName"];
        $image = $_FILES["image"];
        $imgName = $image['name'];
        $imgType = $image['type'];
        $imgTmpName = $image['tmp_name'];
        $imgSize = $image['size'];
        $fileType = array("jpeg","jpg","png");
        $folderVali;
        $imageVali;
        $extension = pathinfo($imgName, PATHINFO_EXTENSION);


        if($folderName == ""){
            $folderVali = "Folder name field is required";
            header("Location: index.php?folderVali=$folderVali&imageVali=$imageVali");
        }

        if($imgName == ""){
            $imageVali = "Image field is required";
            header("Location: index.php?folderVali=$folderVali&imageVali=$imageVali&oldValue=$folderName");
        }else{
            if(in_array($extension,$fileType) === false){
                $imageVali = "Image File extesion must be (JPG,PNG,JPEG)" ;
                header("Location: index.php?folderVali=$folderVali&imageVali=$imageVali&oldValue=$folderName");
            }else{
                if($imgSize >= 2097152){
                    $imageVali = "Image File size must be less than 2000.";
                    header("Location: index.php?folderVali=$folderVali&imageVali=$imageVali&oldValue=$folderName");
                }
            }
        }

        if($folderName != "" && !empty($imgName) && in_array($extension,$fileType) === true && $imgSize < 2097152){
            $curdir = getcwd();
            if(file_exists("images")){
                if(file_exists($folderName)){
                    $targetFile = "images/".$folderName."/".$imgName;
                    move_uploaded_file($imgTmpName,$targetFile);
                    header("Location: index.php?upload=success");
                }else{
                    mkdir($curdir."/images/".$folderName,0777);

                    $targetFile = "images/".$folderName."/".$imgName;
                    move_uploaded_file($imgTmpName,$targetFile);
                    header("Location: index.php?upload=success");
                }
            }else{
                mkdir($curdir."/images",0777);
                    
                if(file_exists($folderName)){
                    $targetFile = "images/".$folderName."/".$imgName;
                    move_uploaded_file($imgTmpName,$targetFile);
                    header("Location: index.php?upload=success");
                }else{
                    mkdir($curdir."/images/".$folderName,0777);

                    $targetFile = "images/".$folderName."/".$imgName;
                    move_uploaded_file($imgTmpName,$targetFile);
                    header("Location: index.php?upload=success");
                }
            }
        }
    }
?>

