<?php
include "main.html";
define('FILE_NAME', 'sample.txt');

if (isset($_POST['send'])) {
    if (is_numeric($_POST['count']) && $_POST['count'] > 0) {
        $count = $_POST['count'];
        delete_words($count);
    }
}

function delete_words($count)
{
    if (!file_exists(FILE_NAME)) {
        return false;
    } else {
        $file = file_get_contents(FILE_NAME);

        $file_words = explode(" ", $file);
        $result = [];

        for($i = 0; $i < count($file_words); $i++) {
            if(strlen($file_words[$i]) <= $count)
                $result[] = $file_words[$i];
            }
        }

       file_put_contents(FILE_NAME, implode(" ", $result));

        return true;
}