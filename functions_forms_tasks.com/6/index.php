<?php
include "main.html";
define('DIR', 'gallery');
define('MAX_FILE_SIZE', 3145728);

if (isset($_POST['send'])) {
    $upload_file = $_FILES['files']['name'];
    $tmp_name = $_FILES['files']['tmp_name'];

    if (!is_uploaded_file($tmp_name)) {
        throw new Error(
            "Файл не был загружен"
        );
    }

    if(!is_type_correct($tmp_name)) {
        throw new Error(
            "Файл имеет неверный формат"
        );
    }



    if ($_FILES['files']['size'] == 0
        || $_FILES['files']['size'] > MAX_FILE_SIZE
    ) {
        throw new Error(
            "Слишком большой файл"
        );
    }

    if (file_to_dir($tmp_name, $upload_file) == true) {
        display_gallery();
    }

}

function file_to_dir($tmp, $file)
{
    if (!is_dir(DIR)) {
        mkdir(DIR);
    }

    return move_uploaded_file($tmp, DIR . '/' . $file);
}

function display_gallery()
{
    $scanned_directory = array_diff(scandir(DIR), array('..', '.'));
    $scanned_directory = array_values($scanned_directory);
    $items = count($scanned_directory);

    echo '<table>';
    echo '<tr>';
    for ($i = 0; $i < $items; $i++) {
        echo "<td><img src=" . DIR . '/' . $scanned_directory[$i] . "></td>";
    }
    echo '<tr>';
    echo '</table>';

}


function is_type_correct($file)
{
    $correct_types = [
      'image/jpeg',
      'image/png',
      'image/gif'
    ];

    $filetype = mime_content_type($file);

    return in_array($filetype, $correct_types);

}