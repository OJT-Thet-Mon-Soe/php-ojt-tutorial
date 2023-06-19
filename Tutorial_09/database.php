<?php
class db{
    function connect(){
        // db connection
        $servername = "localhost";
        $username = "root";
        $password = "Tms2002@";
        $dbname = "chartlist";
        $conn = mysqli_connect($servername,$username,$password);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // create database
        $dbSql = "CREATE DATABASE IF NOT EXISTS $dbname;";
        $conn->query($dbSql);

        // // create table
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
        return $dbConn;
    }
}

$dbConnection = new db();
$dbConn = $dbConnection->connect();

// fake create
$readDataSql = "SELECT * FROM posts";
if(mysqli_num_rows(mysqli_query($dbConn,$readDataSql)) == 0){
    require("seeder.php");
    seeding();
}

class ReadInsertDeleteUpdate extends db{
    // read
    function read(){
        $readSql = "SELECT * FROM posts";
        $readQuery = mysqli_query($this->connect(),$readSql);
        return $readQuery;
    }

    // delete
    function delete($deleteId){
        $deleteSql = "DELETE FROM posts WHERE id = $deleteId";
        mysqli_query($this->connect(),$deleteSql);
        session_start();
        $_SESSION["delete"] = "success";
    }

    // insert
    function insert($title,$content,$publish){
        $insertSql = "INSERT INTO posts (title,content,is_published) VALUES ('$title','$content',$publish)";
        if (mysqli_query($this->connect(),$insertSql) === TRUE) {
            header("Location: index.php?success");
        }
    }

    // edit
    function edit($editId){
        $viewSql = "SELECT * FROM posts WHERE id=$editId";
        $getEditData = mysqli_query($this->connect(),$viewSql);
        return $getEditData;
    }

    // update
    function update($title,$content,$publish,$updateId){
        $updateSql = "UPDATE posts SET title='$title', content='$content', is_published=$publish WHERE id=$updateId";
        mysqli_query($this->connect(),$updateSql);
        header("Location: index.php?update");
    }

    // fakedata insert
    function insertDummyData($title,$content,$isPublish,$date){
        $fakerInsertSql = "INSERT INTO posts (title,content,is_published,created_datetime) 
                        VALUES ('$title','$content',$isPublish,'$date')";
        mysqli_query($this->connect(),$fakerInsertSql);
    }

    // 1week data
    function getWeekData(){
        $startDate = date('Y-m-d', strtotime('this week'));
        $endDate = date('Y-m-d', strtotime('this week +6 days'));
        $weekSql = "SELECT DATE_FORMAT(created_datetime, '%W') AS day, COUNT(*) AS date_count
        FROM posts
        WHERE created_datetime >= '$startDate' AND created_datetime <= '$endDate'
        GROUP BY day";
        $weekResult = mysqli_query($this->connect(),$weekSql);
        return $weekResult;
    }

    // 1year data
    function getYearMonth(){
        $query = "SELECT DATE_FORMAT(created_datetime, '%M')  AS month, COUNT(*) AS count
        FROM posts
        WHERE YEAR(created_datetime) = YEAR(CURRENT_DATE())
        GROUP BY DATE_FORMAT(created_datetime, '%M') 
        ORDER BY DATE_FORMAT(created_datetime, '%M') ";
        $result = mysqli_query($this->connect(),$query);
        return $result;
    }

    // 1month data
    function getMonthDay(){
        $startDate = date("Y")."-".date("m")."-01";
        $endDate = date("Y")."-".date("m")."-31";
        // $query = "SELECT created_datetime AS day, COUNT(*) AS date_count
        // FROM posts
        // WHERE created_datetime BETWEEN '$startDate' AND '$endDate'
        // GROUP BY day
        // ORDER BY day";
        $query = "SELECT DATE_FORMAT(created_datetime, '%Y-%m-%d')  as day,COUNT(created_datetime) AS count FROM posts
        WHERE MONTH(created_datetime) = MONTH(current_date())
        GROUP BY day
        ORDER BY day
        ";
        $result = mysqli_query($this->connect(),$query);
        return $result;
    }
}













