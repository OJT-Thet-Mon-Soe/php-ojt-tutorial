<?php
    require("../database.php");
    // delete data
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        header("Location: ../database.php?deleteId=$id");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tutorial 08</title>
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <div class="wrapper">
      <div class="box clearfix">
        <?php
          if(isset($_GET['success'])){
            echo "
              <div class='alert-box'>
                <div class='success-alert' role='alert'>Created Successfully</div>
              </div>
            ";
          }

          if(isset($_GET['update'])){
            echo "
              <div class='alert-box'>
                <div class='success-alert' role='alert'>Updated Successfully</div>
              </div>
            ";
          }

          if(isset($_GET['delete'])){
            echo "
              <div class='alert-box'>
                <div class='success-alert bg-danger' role='alert'>Deleted Successfully</div>
              </div>
            ";
          }
        ?>
        <a href="create.php" class="btn btn-primary mb-3">Create</a>
        <table class="table table-striped">
          <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>Is Published</th>
            <th>Created Date</th>
            <th>Action</th>
          </tr>
          <?php
            while ($row = mysqli_fetch_assoc($readQuery)) {
                $publishResult;
                if($row["is_published"] == "0"){
                    $publishResult = "Unpublished";
                }else{
                    $publishResult = "Published";
                }
                if (strlen($row["content"]) > 50){
                  $content = substr($row["content"], 0, 50) . ' ...';
                }else{
                  $content = $row["content"];
                }
                $date = date("M d,y",strtotime($row['created_datetime']));
                echo "
                    <tr>
                        <td>{$row['id']}</td>
                        <td>{$row['title']}</td>
                        <td>{$content}</td>
                        <td>{$publishResult}</td>
                        <td>{$date}</td>
                        <td>
                            <a class='btn btn-primary' href='detail.php?readId={$row['id']}'>View</a>
                            <a class='btn btn-success' href='./edit.php?id={$row['id']}'>Edit</a>
                            <a onClick=\"javascript: return confirm('Are you sure to delete?');\" class='btn btn-danger' href='index.php?id={$row['id']}'>Delete</a>
                        </td>
                    </tr>
                ";
            }
          ?>
        </table>
      </div>
    </div>
</body>
</html>