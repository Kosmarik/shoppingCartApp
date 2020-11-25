<?php

namespace App\Service;


class CartDataProcessingService
{
    const PRODUCT_IDENTIFIER = 0;
    const PRODUCT_NAME = 1;
    const PRODUCT_QUANTITY = 2;
    const PRODUCT_PRICE = 3;
    const PRODUCT_CURRENCY = 4;

    private $cartData;
    private $currency;
    private $availableCurrencies = ["EUR", "USD", "GBP"];
    private $currenciesValue = ["EUR" => 1, "USD" => 1.14, "GBP" => 0.88];

    public function __construct(FileReaderService $cartData)
    {
        $this->cartData = $cartData->getFileDataArray();
        print_r($this->cartData);
        $this->currency = $this->getCurrencies($this->availableCurrencies);
        echo $this->currenciesValue[$this->currency] . "\n";
    }

    private function getCurrencies($availableCurrencies)
    {
        CommunicateWithUserService::displayCurrencyForSelect($availableCurrencies);
        $chosenCurrency = CommunicateWithUserService::displayInputBoxToUser();

        if (!array_key_exists($chosenCurrency, $availableCurrencies)) {
            exit("Currency with key '$chosenCurrency' is not found. \n");
        }

        return $availableCurrencies[$chosenCurrency];
    }

}