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

    if ($size > MAX_SIZE || !is_correct_type($tmp_name)) {
        throw new Error(
            "Неверный тип файла или размер файла превышает допустимый (3 MB)"
        );
    }

    $new_image_name = generate_image_name($tmp_name);

    if (!file_to_dir($name, $tmp_name, $new_image_name)) {
        throw new Error(
            "Не удалось загрузить файл"
        );
    }
}


function is_correct_type($name)
{
    $correct_types = [
        'image/jpeg',
        'image/png',
        'image/gif'
    ];

    $filetype = mime_content_type($name);

    if(in_array($filetype, $correct_types)) {
        return true;
    } else {
        return false;
    }
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