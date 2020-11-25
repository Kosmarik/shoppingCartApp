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
    private $currencyConverterService;

    public function __construct(FileReaderService $cartData)
    {
        $this->currencyConverterService = new CurrencyConverterService();
        $this->cartData = $cartData->getFileDataArray();
        $this->currency = $this->getCurrencies($this->availableCurrencies);
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

    public function processCart()
    {

        $totalCartProductsPrice = [];
        $totalCartProductsCount = [];

        foreach ($this->cartData as $product) {

            // If we get product in bad format e.g we use ',' instead of ';' if Cart file.
            if (count($product) == 5) {
                if ($product[self::PRODUCT_QUANTITY] > 0) {
                    $this->currencyConverterService->setConvert($product[self::PRODUCT_PRICE], $product[self::PRODUCT_CURRENCY]);
                    $totalCartProductsPrice[$product[self::PRODUCT_IDENTIFIER]][] =
                        $this->currencyConverterService->getConvert($this->currency) * $product[self::PRODUCT_QUANTITY];
                    $totalCartProductsCount[$product[self::PRODUCT_IDENTIFIER]][] = $product[self::PRODUCT_QUANTITY];
                } elseif ($product[self::PRODUCT_QUANTITY] < 0) {
                    unset($totalCartProductsPrice[$product[self::PRODUCT_IDENTIFIER]]);
                    unset($totalCartProductsCount[$product[self::PRODUCT_IDENTIFIER]]);
                }
            }

            echo "Total cart products (" . $this->getTotal($totalCartProductsCount) . ") price: ";
            echo $this->getTotal($totalCartProductsPrice) . " $this->currency \n";
        }
    }

    private function getTotal($productsPrice) {
        $total = 0;

        foreach ($productsPrice as $productPrice) {
            $total += array_sum($productPrice);
        }

        return round($total, 2);
    }
}