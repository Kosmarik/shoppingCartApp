<?php

namespace App\Service;


class FileReaderService
{
    const FILES_DIR = PATH . '/files/';

    private $fileName;

    public function __construct()
    {
         $this->fileName = $this->getChosenFileName($this->getFilesArray());
         print_r($this->getFileDataArray($this->fileName));
    }

    //Get all files names from files  dir.
    private function getFilesArray()
    {
        $result = [];
        $files = scandir(self::FILES_DIR);

        foreach ($files as $cartFile) {
            if (!in_array($cartFile, [".", ".."]) && is_file(self::FILES_DIR.$cartFile)) {
                $result[] = $cartFile;
            }
        }

        if (empty($result)) {
            exit("No files in " . self::FILES_DIR . " directory. \n");
        }

        return $result;
    }

    private function getChosenFileName($filesArray)
    {
        CommunicateWithUserService::displayFileListForSelect($filesArray);
        $chosenFileKey = CommunicateWithUserService::displayInputBoxToUser();

        if (!array_key_exists($chosenFileKey, $filesArray)) {
            exit("File with key '$chosenFileKey' not found. \n");
        }

        return $filesArray[$chosenFileKey];
    }

    private function getFileDataArray($fileName)
    {
        $shoppingCartArray = [];
        $data = explode("\n",  file_get_contents(self::FILES_DIR.$fileName));

        foreach ($data as $row) {
            $row = explode(';', $row);
            $shoppingCartArray[] = $row;
        }

        return $shoppingCartArray;
    }
}