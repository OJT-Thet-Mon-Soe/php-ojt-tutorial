<?php
    require_once("../database.php");
    if(isset($_POST["createBtn"])){
        $title = $_POST["title"];
        $content = $_POST["content"];
        $publish;
        if(isset($_POST["publish"])){
          $publish = 1;
        }else{
          $publish = 0;
        }

        if($title == ""){
          $errTitle = "Title field is required";
        }

        if($content == ""){
          $errContent = "Content field is required";
        }

        if($title != "" && $content != ""){
            header("Location: ../database.php?title='$title'&content='$content'&is_published='$publish'");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create</title>
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
  <div class="create-box">
    <div class="card">
      <div class="card-header">
        Create Post
      </div>
      <div class="card-body">
        <form method="post">
          <label class="form-label input-label">Title</label>
          <input type="text" name="title" placeholder="Enter title" class="form-control" value="<?php if(isset($title)){echo $title;} ?>">
          <p class="error-msg">
            <?php
                if(isset($errTitle)){
                    echo $errTitle;
                }
            ?>
          </p>
          <label class="form-label input-label">Content</label>
          <textarea name="content" class="form-control" placeholder="Enter content" cols="30" rows="5"><?php if(isset($content)){echo $content;} ?></textarea>
          <p class="error-msg">
            <?php
                if(isset($errContent)){
                    echo $errContent;
                }
            ?>
          </p>
          <div class="form-check">
            <input class="form-check-input" name="publish" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
              Publish
            </label>
          </div>
          <div class="btn-box">
            <a href="index.php" class="btn btn-secondary">Back</a>
            <button class="btn btn-primary" type="submit" name="createBtn">Create</button>
          </div>
        </form>
    </div>   
  </div>     
</body>
</html>

