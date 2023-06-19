<?php
    require("../database.php");
    if(isset($_GET["readId"])){
        $readId = $_GET["readId"];
        $view = new ReadInsertDeleteUpdate();
        $detail = $view->edit($readId);

        while($row = mysqli_fetch_assoc($detail)){
          $date = date("M d,Y",strtotime($row['created_datetime']));
          $is_publish;
          if($row["is_published"] == 1){
            $is_publish = "Publish";
          }else{
            $is_publish = "Unpublish";
          }
          $viewData = array(
              "title"=>$row["title"],
              "content"=>$row["content"],
              "date"=>$date,
              "publish"=>$is_publish
          );
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
        View Post
      </div>
      <div class="card-body">
        <h1 class='detail-ttl'><?php echo $viewData["title"]; ?></h1>
        <p><span><i><?php echo $viewData["publish"]; ?></i></span><span> <?php echo $viewData["date"]; ?></span></p>
        <p><?php echo $viewData["content"]; ?></p>
        <a href='index.php' class='btn btn-secondary'>Back</a>
      </div>   
  </div>     
</body>
</html>