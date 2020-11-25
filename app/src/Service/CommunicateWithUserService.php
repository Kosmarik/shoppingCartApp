<?php

namespace App\Service;


class CommunicateWithUserService
{
    private $availableCurrencies = ["EUR", "USD", "GBP"];

    private function displayInputBoxToUser()
    {
        return trim(fgets(STDIN, 1024));
    }

    public function displayOperationsOptionsToUser()
    {
        echo "Select operation: " . "\n";
        echo "1. Select a file" . "\n";
        echo "2. EXIT SCRIPT" . "\n";

        return $this->displayInputBoxToUser();
    }

    private function displayFileListForSelect($filesArray)
    {
        echo "Choose a file from the list: \n";

        foreach ($filesArray as $key => $file) {
            echo "$key. $file \n";
        }
    }

    private function displayCurrencyForSelect($currencies)
    {
        echo "Chose a currency for output from the list: \n";

        foreach ($currencies as $key => $currency) {
            echo "$key. $currency \n";
        }
    }

    public function getCurrency()
    {
        $this->displayCurrencyForSelect($this->availableCurrencies);
        $chosenCurrency = $this->displayInputBoxToUser();

        if (!array_key_exists($chosenCurrency, $this->availableCurrencies)) {
            exit("Currency with key '$chosenCurrency' is not found. \n");
        }

        return $this->availableCurrencies[$chosenCurrency];
    }

    public function getFileName($filesArray)
    {
        $this->displayFileListForSelect($filesArray);
        $chosenFileKey = $this->displayInputBoxToUser();

        if (!array_key_exists($chosenFileKey, $filesArray)) {
            exit("File with key '$chosenFileKey' is not found. \n");
        }

        return $filesArray[$chosenFileKey];
    }
}