<?php
// connect mysqli
$servername = "localhost";
$username = "root";
$password = "Tms2002@";
$dbname = "Tutorial_08";
$conn = mysqli_connect($servername,$username,$password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// create database
$dbSql = "CREATE DATABASE IF NOT EXISTS $dbname;";
$conn->query($dbSql);

// create table
$dbConn = new mysqli($servername, $username, $password, $dbname);
$createTableSql = "CREATE TABLE posts (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    content TEXT(1000000) NULL,
    is_published BOOLEAN,
    created_datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

if(mysqli_num_rows(mysqli_query($dbConn,"SHOW TABLES LIKE 'posts'")) !=1 ){
    if ($dbConn->query($createTableSql) === FALSE) {
        echo "Error creating table: " . $conn->error;
      }
}

// insert data
if(isset($_GET["title"]) && isset($_GET["content"]) && isset($_GET["is_published"])){
    $title = $_GET["title"];
    $content = $_GET["content"];
    $publish = $_GET["is_published"];
    $insertSql = "INSERT INTO posts (title,content,is_published) VALUES ($title,$content,$publish)";
    if ($dbConn->query($insertSql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }else{
        header("Location: posts/index.php?success='yes'");
    }
}

// read data
$readSql = "SELECT * FROM posts";
$readQuery = mysqli_query($dbConn,$readSql);

// delete data
if(isset($_GET['deleteId'])){
    $deleteId = $_GET['deleteId'];
    $deleteSql = "DELETE FROM posts WHERE id = $deleteId";
    mysqli_query($dbConn,$deleteSql);
    header("Location: posts/index.php?delete");
}

// update data
if(isset($_GET["updateTitle"]) && isset($_GET["updateContent"]) && isset($_GET["updateIs_published"])){
    $id = $_GET["updateId"];
    $title = $_GET["updateTitle"];
    $content = $_GET["updateContent"];
    $publish = $_GET["updateIs_published"];
    $updateSql = "UPDATE posts set title='$title',content='$content',is_published=$publish WHERE id=$id";
    mysqli_query($dbConn,$updateSql);
    header("Location: posts/index.php?update='yes'");
}

// read data
if(isset($_GET["readId"])){
    $readId = $_GET["readId"];
    $viewSql = "SELECT * FROM posts WHERE id=$readId";
    $viewQuery = mysqli_query($dbConn,$viewSql);
    $result = $dbConn->query($viewSql);
    
    $dataInfo;
    foreach($result as $row){
        $date = date("M d,y",strtotime($row['created_datetime']));
        $publishResult;
        if($row["is_published"] == "0"){
            $publishResult = "Unpublished";
        }else{
            $publishResult = "Published";
        }
        $detailTitle = $row['title'];
        $detailContent = $row['content'];
        $dataInfo = array(
            "detailTitle" => $detailTitle,
            "detailContent" => $detailContent,
            "detailIsPublish" => $publishResult,
            "detailDate" => $date
        );
    }
    header("Location: posts/detail.php?".http_build_query($dataInfo));
}

// // edit show data
// if(isset($_GET["editId"])){
//     $editId = $_GET["editId"];
//     $viewSql = "SELECT * FROM posts WHERE id=$editId";
//     $viewQuery = mysqli_query($dbConn,$viewSql);
//     $originData;
//     while($row = mysqli_fetch_assoc($viewQuery)){
//         $date = date("M d,y",strtotime($row['created_datetime']));
//         $publishResult;
//         if($row["is_published"] == "0"){
//             $publishResult = "Unpublished";
//         }else{
//             $publishResult = "Published";
//         }
//         $originData = array(
//             "id" => $editId,
//             "title"=>$row["title"],
//             "content"=>$row["content"],
//             "date"=>$date,
//             "publish"=>$publishResult
//         );
//     }

//     header("Location: edit.php?".http_build_query($originData));
// }
