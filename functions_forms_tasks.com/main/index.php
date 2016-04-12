<?php
define('UPLOAD_DIR', 'upload');
define('MAX_SIZE', 3145728); // 3 MB
define('MAX_UPLOADED', 7);

$photo = get_photo();

if (isset($_POST['send'])) {
    $name = $_FILES['file']['name'];
    $tmp_name = $_FILES['file']['tmp_name'];
    $size = $_FILES['file']['size'];


    if (!is_uploaded_file($tmp_name)) {
        throw new Error(
            "Не удалось загрузить файл"
        );
    }

    $is_type = is_correct_type($name);
    $new_image_name = generate_image_name($tmp_name);
    $is_size = is_correct_size($size);

    if (!$is_type || !$is_size) {
        throw new Error(
            "Неверный тип файла или размер файла превышает допустимый (3 MB)"
        );
    }

    if (!file_to_dir($name, $tmp_name, $new_image_name)) {
        throw new Error(
            "Не удалось загрузить файл"
        );
    }
}


function is_correct_type($name)
{
    $filetype = substr($name, strlen($name) - 3);
    $filetype = mb_strtolower($filetype);

    $correct_types = ['jpg', 'jpeg', 'png', 'gif'];

    foreach ($correct_types as $val) {
        if ($filetype == $val) {
            return true;
        }
    }

    return false;
}

function generate_image_name($image_path)
{

    $types = [
        'image/jpeg' => 'jpg',
        'image/gif' => 'gif',
        'image/png' => 'png'
    ];

    $content_type = mime_content_type($image_path);

    return md5($image_path . time()) . '.' . $types[$content_type];
}

function is_correct_size($size)
{
    return $size <= MAX_SIZE;
}

function file_to_dir($name, $tmp, $file)
{
    $files = array_diff(scandir(UPLOAD_DIR), array('..', '.'));
    if(count($files) == MAX_UPLOADED) {
        return false;
    }

    if (!is_dir(UPLOAD_DIR)) {
        mkdir(UPLOAD_DIR);
    }

    return move_uploaded_file($tmp, UPLOAD_DIR . '/' . $file);

}

function get_photo() {
    $files = array_diff(scandir(UPLOAD_DIR), array('..', '.'));
    $files = array_values($files);


    return $files;
}


include 'main.html';