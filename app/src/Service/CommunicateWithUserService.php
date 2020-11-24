<?php
/**
 * Created by PhpStorm.
 * User: ivasko
 * Date: 2020-11-24
 * Time: 13:13
 */

namespace App\Service;


class CommunicateWithUserService
{
    public static function displayInputBoxToUser()
    {
        return trim(fgets(STDIN, 1024));
    }

    public static function displayOperationsOptionsToUser()
    {
        echo "Select operation: " . "\n";
        echo "1. Select a file" . "\n";
        echo "2. EXIT SCRIPT" . "\n";
    }

    public static function displayFileListForSelect($filesArray)
    {
        echo "Choose a file from the list: \n";

        foreach ($filesArray as $key => $file) {
            echo "$key. $file \n";
        }
    }
}