<?php
define('FILE_COMMENTS', 'comments.txt');

$comments_arr = [];
$comments_arr = get_comments();


if (isset($_POST['send'])) {
    $comment = trim(strip_tags($_POST['comment'], '<b>'));
    $comment = filter($comment);
    if(!empty($comment)) {
        save_comment($comment);
        $comments_arr = get_comments();
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
        while(!feof($f)) {
            $arr[] = fgets($f);
        }
    }

    $arr = array_diff($arr, array(''));
    $arr = array_reverse($arr);

    return $arr;

}

function filter($comment) {
    $bad_words = [
        "плохое_слово1",
        "плохое_слово2",
        "плохое_слово3",
        "плохое_слово4",
        // ...
    ];

    $change = ['***'];

    return str_replace($bad_words, $change[0], $comment);


}


include "main.html";
