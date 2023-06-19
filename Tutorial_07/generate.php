<?php
if(isset($_POST["generate"])){
    $qrName = $_POST["qrName"];
    if($qrName == ""){
        session_start();
        $_SESSION["error"] = "QR Code name is required.";
        header("Location: index.php");
    }else{
        session_start();
        session_destroy();
        include "libs/phpqrcode/qrlib.php";
        $currentURL = getcwd();
        $folderCheck = "images/";
        if(is_dir($folderCheck)){
            $folderName = "images/";
            $imgFile = $folderName.$qrName.".png";
            QRcode::png($qrName,$imgFile);
            session_start();
            $_SESSION["generateImg"] = $imgFile;
            $_SESSION["generateName"] = $qrName;
            header("Location: index.php");
        }else{
            mkdir($currentURL."/images/");

            $folderName = "images/";
            $imgFile = $folderName.$qrName.".png";
            QRcode::png($qrName,$imgFile);
            session_start();
            $_SESSION["generateImg"] = $imgFile;
            $_SESSION["generateName"] = $qrName;
            header("Location: index.php");
        }
    }
}