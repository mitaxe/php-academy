<?php

$files = dir_files_by_name('D:/my_site', 'css');
print_r($files);

function dir_files_by_name($dir_name, $name)
{
    if (is_dir($dir_name)) {
        if ($handle = opendir($dir_name)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..") {
                    $scanned_directory[] = $file;
                }
            }
            closedir($handle);
        }

        $scanned_directory = array_values($scanned_directory);

        foreach ($scanned_directory as $key => $val) {
            if (is_dir($dir_name . '/' . $val) || strpos($val, $name) === false) {
                unset($scanned_directory[$key]);
            }
        }


        if (!empty($scanned_directory)) {
            return $scanned_directory;
        } else {
            return false;
        }
    }

    return false;
}