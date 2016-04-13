<?php
define('FILE_COMMENTS', 'comments.txt');

$comments_arr = [];
$comments_arr = get_comments();


if (isset($_POST['send'])) {
    $comment = trim($_POST['comment']);
    if(!empty($comment)) {
        save_comment($comment);
        $comments_arr = get_comments();
      //  print_r($comments_arr);
    } else {
        throw new Error(
            "Что-то пошло не так"
        );
    }

}

function save_comment($comment)
{
    $comment .= PHP_EOL;
    return file_put_contents(
        FILE_COMMENTS,
        $comment,
        FILE_APPEND
    );
}

function get_comments()
{
    $f = fopen(FILE_COMMENTS, "r");
    $arr = [];
    if ($f) {
        while($arr[] = fgets($f));
    }

    $arr = array_diff($arr, array(''));
    $arr = array_reverse($arr);

    return $arr;

}

include "main.html";
