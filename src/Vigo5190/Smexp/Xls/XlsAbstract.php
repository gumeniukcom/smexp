<?php

namespace Vigo5190\Smexp\Xls;

use \PHPExcel,
    \PHPExcel_IOFactory;

abstract class XlsAbstract implements XlsInterface{

    /** @var \PHPExcel  */
    protected $XlsDocument;

    public function __construct() {
        $this->XlsDocument = new \PHPExcel();
        $this->init();
    }

    public function setData(Array $data){
        try{
            $i = 1;
            foreach($data as $row){
                $j=1;
                foreach($row as $cell){
                    $this->XlsDocument->setActiveSheetIndex(0)
                              ->setCellValue($j++.$i, $cell);
                }
                $i++;
            }
        } catch (\Exception $e){
            throw new \ErrorException(
                sprintf('Can\'t set data to Xls, because: %s',  $e->getMessage()),
                $e->getCode(),
                1,
                $e->getFile(),
                $e->getLine(),
                $e
            );
        }

    }

    public function dumpXlsToFile($fileNameWithFullPathWithOutExtension){
        $objWriter = PHPExcel_IOFactory::createWriter($this->XlsDocument, 'Excel2007');
        $filename = $fileNameWithFullPathWithOutExtension;
        try{
            $objWriter->save($filename);
        } catch (\Exception $e){
            throw new \ErrorException(
                sprintf('Can\'t dump xls to file %s, because: %s', $fileNameWithFullPathWithOutExtension, $e->getMessage()),
                $e->getCode(),
                1,
                $e->getFile(),
                $e->getLine(),
                $e
            );
        }

    }

    protected function init(){
        $this->initInfo();
        $this->initStyle();
    }

    protected function initInfo(){
        $this->XlsDocument->getProperties()->setCreator("user")
                  ->setLastModifiedBy("username")
                  ->setTitle("Title")
                  ->setSubject("Название.")
                  ->setDescription("Описание")
                  ->setKeywords("php, all results")
                  ->setCategory("some category");
    }
    protected function initStyle(){
        $this->XlsDocument->getDefaultStyle()->getFont()
                  ->setName('Arial')
                  ->setSize(10);

        $this->XlsDocument->getActiveSheet()->setTitle('Regs');
        $this->XlsDocument->setActiveSheetIndex(0);
    }



} 