<?php
include "main.html";

if(isset($_POST['send'])) {
    if(isset($_POST['text'])) {
        $text = $_POST['text'];
        $result = unique($text);
        echo $result;
    }
}

function unique($str) {

    $unique_count = 0;
    $str = mb_strtolower($str);
    $arr = explode(" ", $str);

    for($i = 0; $i < count($arr); $i++) {
        $count = 0;
        for($j = 0; $j < count($arr); $j++) {
            if($arr[$i] == $arr[$j]) {
                $count++;
            }
        }
        if($count == 1) {
            $unique_count++;
        }
    }
   return $unique_count;
}