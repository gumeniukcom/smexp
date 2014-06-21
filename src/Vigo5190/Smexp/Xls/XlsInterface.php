<?php

namespace Vigo5190\Smexp\Xls;

interface XlsInterface {

    /**
     * @param $data
     * @throws \ErrorException
     */
    public function setData($data);

    /**
     * Принимает на вход полный путь до файла, без расширения
     *
     * @param $fileNameWithFullPathWithOutExtension
     * @throws \ErrorException
     */
    public function dumpXlsToFile($fileNameWithFullPathWithOutExtension);
} 