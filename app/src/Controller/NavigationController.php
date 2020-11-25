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

    public function __construct()
    {
        $this->loadChosenOperation();
    }

    private function loadChosenOperation()
    {
        $operation = $this->getOperation();

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

    private function getOperation()
    {
        CommunicateWithUserService::displayOperationsOptionsToUser();
        $chosenOperation = CommunicateWithUserService::displayInputBoxToUser();

        return $chosenOperation;
    }
}