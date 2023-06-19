<?php

class db{
    function connect(){
        // connect mysqli
        $servername = "localhost";
        $username = "root";
        $password = "Tms2002@";
        $dbname = "auth";
        $conn = mysqli_connect($servername,$username,$password);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // create database
        $dbSql = "CREATE DATABASE IF NOT EXISTS $dbname;";
        $conn->query($dbSql);

        // create table
        $dbConn = new mysqli($servername, $username, $password, $dbname);
        $createTableSql = "CREATE TABLE users (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            phone VARCHAR(255) NOT NULL,
            img VARCHAR(255) NULL,
            address TEXT(1000000) NOT NULL,
            created_datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";
        if(mysqli_num_rows(mysqli_query($dbConn,"SHOW TABLES LIKE 'users'")) !=1 ){
            if ($dbConn->query($createTableSql) === FALSE) {
                echo "Error creating table: " . $conn->error;
            }
        }

        return $dbConn;
    }
}

class AuthData extends db{
    // insert data
    function getData($name,$email,$phone,$password,$address){
        $insertSql = "INSERT INTO users (name,email,phone,password,address)
                    VALUES ('$name','$email',$phone,'$password','$address')";
        mysqli_query($this->connect(),$insertSql);
    }

    // read email 
    function getEmail($email){
        $insertSql = "SELECT * FROM users WHERE email='$email'";
        $emailQuery = mysqli_query($this->connect(),$insertSql);
        return $emailQuery;
    }

    // get password
    function getPassword($email){
        $insertSql = "SELECT * FROM users WHERE email='$email'";
        $passwordQuery = mysqli_query($this->connect(),$insertSql);
        return $passwordQuery;
    }

    // read data
    function getId($id){
        $readSql = "SELECT * FROM users WHERE id='$id'";
        $userData = mysqli_query($this->connect(),$readSql);
        return $userData;
    }

    // update user data
    function getUpdate($id,$name,$email,$image){
        $updateSql = "UPDATE users
        SET name='$name',email='$email',img='$image'
        WHERE id=$id;
        ";
        $userData = mysqli_query($this->connect(),$updateSql);
        return $userData;
    }

    // reset password
    function updatePassword($email,$password){
        $updatePwSql = "UPDATE users
        SET password='$password'
        WHERE email='$email';
        ";
        mysqli_query($this->connect(),$updatePwSql);
    }
}




