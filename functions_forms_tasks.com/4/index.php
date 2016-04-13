<?php

$files = dir_files('D:/my_site');
print_r($files);

function dir_files($dir_name)
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

            if (is_dir($dir_name . '/' . $val)) {
                unset($scanned_directory[$key]);
            }
        }
        $scanned_directory = array_values($scanned_directory);
        return $scanned_directory;
    }

    return false;
}