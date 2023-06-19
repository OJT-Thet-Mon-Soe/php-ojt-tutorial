<?php
function createPhoneNumber($numberArray)
{
    $phoneNoCount = count($numberArray);
    for ($i=0; $i < $phoneNoCount ; $i++) { 
        if($i == 0){
            echo "(".$numberArray[$i];
        }elseif($i == 2){
            echo $numberArray[$i].") ";
        }elseif($i == 5){
            echo $numberArray[$i]."-";
        }else{
            echo $numberArray[$i];
        }
    }
}
createPhoneNumber([1, 1, 1, 1, 1, 1, 1, 1, 1, 1]);

// Result
// createPhoneNumber([1, 2, 3, 4, 5, 6, 7, 8, 9, 0]); // output => (123) 456-7890
// createPhoneNumber([1, 1, 1, 1, 1, 1, 1, 1, 1, 1]); // output => (111) 111-1110
