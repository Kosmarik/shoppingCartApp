<?php

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

    public static function displayCurrencyForSelect($currencies)
    {
        echo "Chose a currency from the list: \n";

        foreach ($currencies as $key => $currency) {
            echo "$key. $currency \n";
        }
    }
}