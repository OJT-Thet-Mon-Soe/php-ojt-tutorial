<?php
    if(isset($_GET["readId"])){
        $readId = $_GET["readId"];
        header("Location: ../database.php?readId=$readId");
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
        <h1 class='detail-ttl'><?php echo $_GET["detailTitle"] ?></h1>
        <p><span><i><?php echo $_GET["detailIsPublish"] ?></i></span><span> <?php echo $_GET["detailDate"] ?></span></p>
        <p><?php echo $_GET["detailContent"] ?></p>
        <a href='index.php' class='btn btn-secondary'>Back</a>
      </div>   
  </div>     
</body>
</html>