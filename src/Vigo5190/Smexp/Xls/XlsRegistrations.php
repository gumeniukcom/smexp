<?php

namespace Vigo5190\Smexp\Xls;

use Vigo5190\Smexp\Entities\Registration,
    PHPExcel_Cell_Hyperlink,
    PHPExcel_Style_Alignment,
    PHPExcel_Style_Font;

class XlsRegistrations extends XlsAbstract implements XlsInterface {

    public function setData($data) {
        try {
            $i = 1;
            $maxCol = 'A';
            /** @var Registration[] $data */
            foreach ($data as $reg) {
                $j = 'A';
                $this->XlsDocument->setActiveSheetIndex(0)
                                  ->setCellValue($j++ . $i, $reg->getId())
                                  ->setCellValue($j++ . $i, $reg->getSomedata1())
                                  ->setCellValue($j++ . $i, $reg->getName())
                                  ->setCellValue($j++ . $i, $reg->getSecondName())
                                  ->setCellValue($j++ . $i, $reg->getLastName())
                                  ->setCellValue($j++ . $i, $reg->getBirthday()->format("Y-m-d"))
                                  ->setCellValue($j++ . $i, $reg->getPhone())
                                  ->setCellValue($j++ . $i, $reg->getEmail())
                                  ->setCellValue($j++ . $i, $reg->getCity());

                $this->XlsDocument->setActiveSheetIndex(0)
                                  ->setCellValue($j++ . $i, $reg->getImei(), true)
                                  ->setDataType();

                $this->XlsDocument->setActiveSheetIndex(0)
                                  ->setCellValue($j++ . $i, $reg->getModel())
                                  ->setCellValue($j++ . $i, $reg->getDateBuy()->format("Y-m-d"));

                $styleArray = [
                    'font' => [
                        'bold'      => true,
                        'color'     => array('rgb' => '3366BB'),
                        'underline' => PHPExcel_Style_Font::UNDERLINE_SINGLE,
                    ]
                ];

                $file = $reg->getImgPath();
                $file = str_replace("/", ":", $file);
                $file = "external://" . $file;

                $link = new PHPExcel_Cell_Hyperlink($file, $file);

                $this->XlsDocument
                    ->setActiveSheetIndex(0)
                    ->setCellValue($j . $i, $reg->getImgPath(), true)
                    ->setHyperlink($link);

                $this->XlsDocument
                    ->getActiveSheet()
                    ->getStyle($j . $i)
                    ->getAlignment()
                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_GENERAL);

                $this->XlsDocument
                    ->getActiveSheet()
                    ->getStyle($j . $i)
                    ->applyFromArray($styleArray);

                $i++;

                $maxCol = $j;

            }

            for ($i = 'A'; $i <= $maxCol; $i++) {
                $this->XlsDocument->getActiveSheet()
                                  ->getColumnDimension($i)->setAutoSize(true);
            }

        } catch (\Exception $e) {
            throw new \ErrorException(
                sprintf('Can\'t set data to Xls, because: %s', $e->getMessage()),
                $e->getCode(),
                1,
                $e->getFile(),
                $e->getLine(),
                $e
            );
        }

    }

} 