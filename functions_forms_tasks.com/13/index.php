<?php

$string = 'яблоко черешня вишня вишня черешня груша яблоко черешня вишня яблоко вишня вишня черешня груша яблоко черешня черешня вишня яблоко вишня вишня черешня вишня черешня груша яблоко черешня черешня вишня яблоко вишня вишня черешня черешня груша яблоко черешня вишня';

$result =  @count_values($string);
echo "<pre>";
print_r($result);
echo "</pre>";


function count_values($str) {
    $arr = explode(" ", $str);
    $res = [];
    foreach($arr as $value) {
        $res[mb_strtolower($value)]++;
    }

    return $res;
}
