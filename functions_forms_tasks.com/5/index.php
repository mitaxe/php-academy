<?php

$files = dir_files_by_name('D:/my_site', 'css');
print_r($files);

function dir_files_by_name($dir_name, $name)
{
    if (file_exists($dir_name)) {
        $scanned_directory = array_diff(scandir($dir_name), array('..', '.'));
        $scanned_directory = array_values($scanned_directory);

        foreach ($scanned_directory as $key => $val) {
            if (is_dir($dir_name . '/' . $val)) {
                unset($scanned_directory[$key]);
            }
        }

        foreach ($scanned_directory as $key => $val) {
            if (strpos($val, $name) === false) {
                unset($scanned_directory[$key]);
            }
        }

        $scanned_directory = array_values($scanned_directory);

        if (!empty($scanned_directory)) {
            return $scanned_directory;
        } else {
            return false;
        }
    }

    return false;
}