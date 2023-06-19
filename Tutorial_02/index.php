<?php
        function makeDiamondShape($row)
        {
            $n = $row;
            if(gettype($n) == "string"){
                echo "Row parameter must be number.";
            }elseif ($n%2 == 0) {
                echo "Row parameter must be odd number.";
            }else{
                for($i = 1;$i <= ($n/2)+1;$i++){
                    for($j = 1;$j <= (2*$n)-1;$j++){
                        if($j >= $n-($i-1) && $j <= $n+($i-1)){
                            echo "*";
                        }else{
                            echo "&nbsp&nbsp";
                        }
                    }
                    echo "<br>";
                }
                for($i = ($n/2);$i >= 1;$i--){
                    for($j = 1;$j <= (2*$n)-1;$j++){
                        if($j >= $n-($i-1) && $j <= $n+($i-1)){
                            echo "*";
                        }else{
                            echo "&nbsp&nbsp";
                        }
                    }
                    echo "<br>";
                }
            }
        }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorial 02</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class='diamond-box'>
        <h1 class='diamond-ttl'>Diamond Pattern</h1>
        <?php
            makeDiamondShape(5);
        ?>
    </div>
</body>
</html>

<?php
// Result

// makeDiamondShape(1);
// output
//  *

// makeDiamondShape(3);
// output
//  *
// ***
//  *

// makeDiamondShape(5);
// output
//   *
//  ***
// *****
//  ***
//   *

// makeDiamondShape(6);
// output
// $row parameter must be odd number. //validation

// makeDiamondShape(2);
// output
// $row parameter must be odd number. //validation

// makeDiamondShape('three');
// output
// $row parameter must be number. //validation
?>