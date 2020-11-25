<?php

namespace App\Service;


class CurrencyConverterService
{
    private $rateValue;
    private $rates = [
        "EUR" => 1.0,
        "USD" => 1.14,
        "GBP" => 0.88
    ];

    public function setConvert($amount, $currencyFrom)
    {
        $this->rateValue = $amount / $this->rates[$currencyFrom];
    }

    public function getConvert($currencyTo)
    {
        return $this->rates[$currencyTo] * $this->rateValue;
    }

    public function getRates()
    {
        return $this->rates;
    }
}