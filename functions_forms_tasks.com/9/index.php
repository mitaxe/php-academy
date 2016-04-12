<?php
include 'main.html';

if(isset($_POST['send'])) {
    if(isset($_POST['text'])) {
        $text = $_POST['text'];
        $text = convert_string($text);
        echo $text;
    }
}

function convert_string($str) {
    $res_str = '';
    for($i = strlen($str) - 1; $i>=0; $i--) {
        $res_str.= $str[$i];
    }

    return $res_str;
}