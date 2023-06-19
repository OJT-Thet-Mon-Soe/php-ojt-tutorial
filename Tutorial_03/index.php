<?php
    $tomorrow = date("Y-m-d",strtotime("tomorrow"));
    $todayDate = date("Y-m-d");
    if(isset($_POST['calculate'])){
        $date = $_POST['dateOfBirth'];
        $error;
        if($date == ""){
            $error = "data field is required";
        }elseif($date == $tomorrow){
            $error = "date must not equal tomorrow.";
        }elseif($date > $tomorrow){
            $error = "date must not greater than tomorrow.";
        }else{
            $diff=date_diff(date_create($date),date_create($todayDate));
            $day = $diff->format("%a days");
            $year = $diff->format("%y years");
            $month = $diff->format("%m months");
            $success = "Your age is ".$year." , ".$month." and ".$day;;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Age Calculator</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="wrapper">
        <?php
            if(isset($success)){
        ?>
            <p class="success-msg">
                <?php echo $success; ?>
            </p>
        <?php
            }
        ?>

        <div class="box">
            <h1 class="age-ttl">Age Calculator</h1>
            <form method="post">
                <div class="date-box">
                    <label>Date of birth : </label>
                    <input type="date" name="dateOfBirth">
                    <p class="valiError">
                        <?php
                            if(isset($error)){
                                echo $error;
                            }
                        ?>
                    </p>
                </div>
                <input type="submit" value="Calculate" class="calculate-btn" name="calculate">
            </form>
        </div>
    </div>
</body>
</html>