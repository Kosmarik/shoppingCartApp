<?php

namespace App\Controller;


use App\Service\CommunicateWithUserService;

class NavigationController
{
    //Available operations.
    //If you would like to add more operations, you
    //should edit CommunicateWithUserService::displayOperationsOptionsToUser
    const READ_FILE_SOURCE = 1;
    const EXIT_SCRIPT = 2;

    private $communicateWithUserService;

    public function __construct()
    {
        $this->communicateWithUserService = new CommunicateWithUserService();
        $this->loadChosenOperation();
    }

    private function loadChosenOperation()
    {
        $operation = $this->communicateWithUserService->displayOperationsOptionsToUser();

        if (!in_array($operation, [self::READ_FILE_SOURCE, self::EXIT_SCRIPT])) {
            echo "You must choose from the list of operations!";
            $this->loadChosenOperation();
            exit();
        }

        switch ($operation) {
            case self::READ_FILE_SOURCE:
                new ShoppingCartController();
                break;
        }
    }
}