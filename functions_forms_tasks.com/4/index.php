<?php

$files = dir_files('D:/my_site');
print_r($files);

function dir_files($dir_name)
{
    if (file_exists($dir_name)) {
        $scanned_directory = array_diff(scandir($dir_name), array('..', '.'));
        $scanned_directory = array_values($scanned_directory);

        foreach($scanned_directory as $key => $val) {

            if(is_dir($dir_name.'/'.$val)) {
                unset($scanned_directory[$key]);
            }
        }
        $scanned_directory = array_values($scanned_directory);
        return $scanned_directory;
    }

    return false;
}