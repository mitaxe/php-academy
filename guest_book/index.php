<?php
define('COMMENT_DIR', 'comments');
define('COMMENT_FILE', 'comments.txt');


function render_page()
{
    if (isset($_POST['send'])) {
        if (
            isset($_POST['name']) &&
            isset($_POST['email']) &&
            isset($_POST['subject']) &&
            isset($_POST['comment']) &&
            !empty($_POST['name']) &&
            !empty($_POST['email']) &&
            !empty($_POST['subject']) &&
            !empty($_POST['comment'])
        ) {
            $comment = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'subject' => trim($_POST['subject']),
                'comment' => trim(htmlspecialchars($_POST['comment'])),
                'time' => date('l jS \of F Y h:i:s A')
            ];

            save_comment($comment);
        }
    }

    $guest_comments = get_comment();
    include 'main.php';
}

function save_comment($comment)
{

    if (!is_dir(COMMENT_DIR)) {
        mkdir(COMMENT_DIR);
    }

    return file_put_contents(COMMENT_DIR . DIRECTORY_SEPARATOR . COMMENT_FILE, serialize($comment) . PHP_EOL, FILE_APPEND);
}

function get_comment()
{
    $result = [];
    if (file_exists(COMMENT_DIR . DIRECTORY_SEPARATOR . COMMENT_FILE)) {
        $handle = fopen(COMMENT_DIR . DIRECTORY_SEPARATOR . COMMENT_FILE, "r");
        if ($handle) {
            while (($buffer = fgets($handle)) !== false) {
                $result[] = unserialize($buffer);
            }
            fclose($handle);
        }
    }

    return $result;
}

render_page();
