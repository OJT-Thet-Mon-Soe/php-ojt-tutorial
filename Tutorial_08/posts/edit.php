<?php
    require("../database.php");
    $data;
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $viewSql = "SELECT * FROM posts WHERE id=$id";
        $viewQuery = mysqli_query($dbConn,$viewSql);

        while($row = mysqli_fetch_assoc($viewQuery)){
            $date = date("M d,y",strtotime($row['created_datetime']));
            $data = array(
                "title"=>$row["title"],
                "content"=>$row["content"],
                "date"=>$date,
                "publish"=>$row["is_published"]
            );
        }
    }

    if(isset($_POST["updateBtn"])){
        $title = $_POST["title"];
        $content = $_POST["content"];
        $publishResult;
        if(isset($_POST["publish"])){
            $publishResult = 1;
            $data["publish"] = 1;
        }else{
            $publishResult = 0;
            $data["publish"] = 0;
        }

        if($title == ""){
            $data["title"] = "";
            $errTitle = "Title field is required";
        }else{
            $data["title"] = $title;
        }
    
        if($content == ""){
            $data["content"] = "";
            $errContent = "Content field is required";
        }else{
            $data["content"] = $content;
        }

        if($title != "" && $content != ""){
            $updateData = array(
                'updateTitle' => $title,
                'updateContent' => $content,
                'updateIs_published' => $publishResult,
                'updateId' => $id,
            );
            header("Location: ../database.php?".http_build_query($updateData));
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Page</title>
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
  <div class="create-box">
    <div class="card">
      <div class="card-header">
        Edit Post
      </div>
      <div class="card-body">
        <form method="post">
          <label class="form-label input-label">Title</label>
          <input type="text" name="title" placeholder="Enter title" class="form-control" value="<?php echo $data["title"];?>">
          <p class="error-msg">
            <?php
                if(isset($errTitle)){
                    echo $errTitle;
                }
            ?>
          </p>
          <label class="form-label input-label">Content</label>
          <textarea name="content" placeholder="Enter content" cols="30" rows="5" class="form-control"><?php echo $data["content"]; ?></textarea>
          <p class="error-msg">
            <?php
                if(isset($errContent)){
                    echo $errContent;
                }
            ?>
          </p>
          <div class="form-check">
            <input class="form-check-input" name="publish" type="checkbox" <?php if($data['publish'] == 1){echo 'checked';}?> id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
              Publish
            </label>
          </div>
          <div class="btn-box">
            <a href="index.php" class="btn btn-secondary">Back</a>
            <button class="btn btn-primary" type="submit" name="updateBtn">Update</button>
          </div>
        </form>
      </div>   
  </div>     
</body>
</html>
