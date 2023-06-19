<?php

function arrayDiff($arr1, $arr2)
{
    if($arr2 == []){
        print_r($arr1);
    }else{
        for ($i=0;$i<count($arr2);$i++) { 
            if(in_array($arr2[$i],$arr1)){
                $noArr = array();
                for ($s=0; $s < count($arr1); $s++) { 
                    if($arr1[$s] == $arr2[$i]){
                        array_splice($arr1,$s,$s+1,$noArr);
                    }
                }
            }
        }
        print_r($arr1);
    }
}
arrayDiff([1, 2], [1]);

// Result
// arrayDiff([1, 2], [1]); // output => [2]
// arrayDiff([1, 2, 2], [1]); // output => [2, 2]
// arrayDiff([1, 2, 2], [2]); // output => [1]
// arrayDiff([1, 2, 2], []); // output => [1, 2, 2]
// arrayDiff([], [1, 2]); // output => []
// arrayDiff([1, 2, 3], [1, 2]); // output => [3]
