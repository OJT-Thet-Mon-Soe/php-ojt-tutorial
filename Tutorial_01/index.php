<?php
        function drawChessBorad($rows, $cols)
        {
            $r = $rows;
            $c = $cols;
            if ($r == 0 && $c == 0) {
                echo "Rows and Cols parameters must be greater than 0.";
            }elseif($c == 0){
                if (gettype($r) == "string" && $c == 0) {
                    echo "Rows parameter must be number.Cols parameter must be greater than 0.";
                }else{
                echo "Cols parameter must be greater than 0.";
                }
            }elseif($r == 0){
                if ($r == 0 && gettype($c) == "string" ) {
                echo "Rows parameter must be greater than 0.Cols parameter must be number.";
                }else{
                echo "Rows parameter must be greater than 0.";
                }
            }elseif(gettype($r) == "string" && gettype($c) == "string"){
            echo "Rows and Cols parameters must be number.";
            }elseif(gettype($r) == "string"){
            echo "Rows parameter must be number.";
            }elseif(gettype($c) == "string"){
            echo "Cols parameter must be number.";
            }else{
                for ($i=1; $i <= $r ; $i++) { 
                    echo "<tr>";
                    for ($j=1; $j <= $c ; $j++) { 
                        if(($i+$j)%2 == 0){
                            echo "<td class='white'></td>";
                        }else{
                            echo "<td class='black'></td>";
                        }
                    }
                    echo "</tr>";
                }
            }
        }
    ?> 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Draw Chess Board</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class='chessboard-box'>
    <h1 class='chessboard-ttl'>Chessboard</h1>
    <table>
        <?php
            drawChessBorad(8,8);
        ?>
    </table>
  </div>
</body>
</html>

<?php
// drawChessBorad(8, 8); // output => 8 rows and 8 columns chess borad.
// drawChessBorad(5, 2); // output => 5 rows and 2 columns chess borad.
// drawChessBorad(0, 1); // output => $rows parameter must be greater than 0. //validation
// drawChessBorad(1, 0); // output => $cols parameter must be greater than 0. //validation
// drawChessBorad(0, 0); // output => $rows and $cols parameters must be greater than 0. //validation
// drawChessBorad('myrow', 'mycols'); // output => $rows and $cols parameters must be number. //validation
// drawChessBorad('myrow', 5); // output => $rows parameter must be number. //validation
// drawChessBorad(5, 'mycols'); // output => $cols parameter must be number. //validation
// drawChessBorad(0, 'mycols'); // output => $rows parameter must be greater than 0.$cols parameter must be number. //validation
// drawChessBorad('myrow', 0); // output => $rows parameter must be number.$cols parameter must be greater than 0. //validation
?>

