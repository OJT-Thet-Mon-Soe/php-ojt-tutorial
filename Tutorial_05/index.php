<?php
    // txt
    function phpFileRead($fileName){
        $fileOpen = fopen($fileName,"r") or die("unable to open file");
        $fileContent = fread($fileOpen,filesize($fileName));
        fclose($fileOpen);
        return $fileContent;
    }

    // doc
    function readWord($filename) {
        if(file_exists($filename))
        {
            if(($fh = fopen($filename, 'r')) !== false ) 
            {
               $headers = fread($fh, 0xA00);
               $n1 = ( ord($headers[0x21C]) - 1 );
               $n2 = ( ( ord($headers[0x21D]) - 8 ) * 256 );
               $n3 = ( ( ord($headers[0x21E]) * 256 ) * 256 );
               $n4 = ( ( ( ord($headers[0x21F]) * 256 ) * 256 ) * 256 );
               $textLength = ($n1 + $n2 + $n3 + $n4);
               $extractedPlaintext = fread($fh, $textLength);
               return nl2br($extractedPlaintext);
            } else {
              return false;
            }
        } else {
          return false;
        }  
    }
    
    // excel
    use Shuchkin\SimpleXLSX;
    function myExcel(){
     ini_set('error_reporting', E_ALL);
     ini_set('display_errors', true);
     require_once __DIR__.'/SimpleXLSX.php';
     if ($xlsx = SimpleXLSX::parse('files/sample.xlsx')) {
         $data = $xlsx->rows();
         for ($i=0; $i < count($data); $i++) { 
             ?>
             <tr>
             <?php
             for ($j=0; $j < count($data[$i]); $j++) { 
                 echo "<td>".$data[$i][$j]."</td>";
             }
             ?>
             </tr>
             <?php
         }
     } else {
         echo SimpleXLSX::parseError();
     }
    }

    // csv
    function myCsv(){
        $startRow = 1;
        if(($csvFile = fopen("files/sample.csv","r")) !== FALSE){
            while (($readData = fgetcsv($csvFile,1000,",")) !== FALSE) {
                $columnCount = count($readData);
                ?>
                <tr>
                <?php
                $startRow++;
                for ($c=0; $c < $columnCount ; $c++) { 
                    ?>
                        <td>
                    <?php
                    echo $readData[$c];
                    ?>
                    </td>
                    <?php
                }
                ?>
                </tr>
                <?php
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tutorail 05</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="wrapper">
        <!-- text file -->
        <h1 class="cmn-ttl">Text File</h1>
        <div class="txt-box">
            <?php
                echo nl2br(phpFileRead("files/sample.txt"));
            ?>
        </div>

        <!-- doc file -->
        <h1 class="cmn-ttl">Document File</h1>
        <div class="doc-box">
            <?php
                echo readWord("files/sample.doc");
            ?>
        </div>

        <!-- excel file -->
        <h1 class="cmn-ttl">Excel File</h1>
        <table>
            <?php
                myExcel();
            ?>
        </table>

        <!-- csv file -->
        <h1 class="cmn-ttl">CSV File</h1>
        <table border="1">
            <?php
                myCsv();
            ?>
        </table>
    </div>
</body>
</html>
