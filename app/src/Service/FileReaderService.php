<?php

namespace App\Service;


class FileReaderService
{
    const FILES_DIR = PATH . '/files/';

    private $communicateWithUserService;
    private $fileName;

    public function __construct()
    {
        $this->communicateWithUserService = new CommunicateWithUserService();
        $this->fileName = $this->communicateWithUserService->getFileName($this->getFilesArray());
    }

    //Get all files names from files dir.
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

    public function getFileDataArray()
    {
        $fileName = $this->fileName;
        $shoppingCartArray = [];
        $data = explode("\n",  file_get_contents(self::FILES_DIR.$fileName));

        foreach ($data as $row) {
            $row = explode(';', $row);
            $shoppingCartArray[] = $row;
        }

        return $shoppingCartArray;
    }
}