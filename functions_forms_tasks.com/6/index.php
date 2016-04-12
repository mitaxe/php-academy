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

    $filetype = substr($upload_file, strlen($upload_file) - 3);

    if ($filetype != "jpg" &&
        $filetype != "jpeg" &&
        $filetype != "gif" &&
        $filetype != "bmp" &&
        $filetype != "png"
    ) {
        throw new Error(
            "Неверный формат файла"
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

    if (move_uploaded_file($tmp, DIR . '/' . $file)) {
        return true;
    } else {
        return false;
    }
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