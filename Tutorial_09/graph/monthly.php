<?php
    require("../database.php");
    $getWeekly = new ReadInsertDeleteUpdate();
    $weekResult = $getWeekly->getMonthDay();
    $dayData = [];
    while($row = mysqli_fetch_assoc($weekResult)){
        $day = date("Y-m-d",strtotime($row["day"]));
        $dayData[$day] = $row["count"];
    }
    $month = date('m');
    $year = date('Y');
    $numDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $dates = [];
    $data = [];
    $currentMonthDay;
    for ($day = 1; $day <= $numDays; $day++) {
        $date = date('Y-m-d', strtotime("$year-$month-$day"));
        $dates[] = $date;
        $data[] = rand(0, 100);
        $currentMonthDay[$date]=0;
    }
    $resultArray = array_merge($currentMonthDay, $dayData);
    $mydata = array();
    foreach($resultArray as $key => $value){
        array_push($mydata,$value);
    }
    $chartData = json_encode([
        'labels' => $dates,
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
          <a href="../graph/monthly.php" class="btn btn-secondary mb-3">Monthly</a>
          <a href="../graph/yearly.php" class="btn btn-outline-secondary mb-3">Yearly</a>
        </div>
    </div>

    <canvas id="myChart"></canvas>

    <script>
    // Get the chart data from PHP
    var chartData = <?php echo $chartData; ?>;

    // Create the bar chart
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
        labels: chartData.labels,
        datasets: [{
            label: 'Monthly',
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