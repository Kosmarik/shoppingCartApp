<?php

namespace App\Controller;


use App\Service\CartDataProcessingService;
use App\Service\FileReaderService;

class ShoppingCartController
{
    private $cartDataArray;
    private $cartDataProcessingService;

    public function __construct()
    {
        $this->cartDataArray = new FileReaderService();
        $this->cartDataProcessingService = new CartDataProcessingService($this->cartDataArray);
        $this->cartDataProcessingService->processCart();
    }
}