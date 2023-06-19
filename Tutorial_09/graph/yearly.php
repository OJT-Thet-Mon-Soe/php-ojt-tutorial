<?php
    require("../database.php");
    $data = new ReadInsertDeleteUpdate();
    $result = $data->getYearMonth();
    $month=[];
    $monthCount=[];
    $monthAndCount=[];
    while($row = mysqli_fetch_assoc($result)){
    $month[] = $row["month"];
    $monthCount[] = $row["count"];
    $monthAndCount[$row['month']] = $row["count"];
    }
    $allMonthsArray = array(
        "January" => 0,
        "February" => 0,
        "March" => 0,
        "April" => 0,
        "May" => 0,
        "June" => 0,
        "July" => 0,
        "August" => 0,
        "September" => 0,
        "October" => 0,
        "November" => 0,
        "December" => 0
    );
    $resultArray = array_merge($allMonthsArray, $monthAndCount);
    $mydata = array();
    foreach($resultArray as $key => $value){
        array_push($mydata,$value);
    }
    // Example data for 12 months
    $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    
    // Convert PHP data to JSON for JavaScript consumption
    $chartData = json_encode([
    'labels' => $months,
    'values' => $mydata,
    ]);
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tutorial 09</title>
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>
    <div class="wrapper graph">
      <div class="btn-all-box">
        <a href="../posts/index.php" class="btn btn-secondary mb-3">Back</a>
        <div class="right-btn">
          <a href="../graph/weekly.php" class="btn btn-outline-secondary mb-3">Weekly</a>
          <a href="../graph/monthly.php" class="btn btn-outline-secondary mb-3">Monthly</a>
          <a href="../graph/yearly.php" class="btn btn-secondary mb-3">Yearly</a>
        </div>
    </div>

    <canvas id="myChart"></canvas>

    <script>
    var chartData = <?php echo $chartData; ?>;

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
        labels: chartData.labels,
        datasets: [{
            label: 'yearly',
            data: chartData.values,
            backgroundColor: 'rgba(0, 123, 255, 0.5)',
        }]
        },
        options: {
        }
    });
    </script>

</body>
</html>