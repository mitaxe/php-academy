<?php
include "main.html";

if(isset($_POST['send'])) {
    if(isset($_POST['text'])) {
        $text = $_POST['text'];
        $result = unique_count($text);
        echo $result;
    }
}

function unique_count($str) {

    $arr = explode(" ", $str);
    $arr = array_unique($arr);

    return count($arr);
}