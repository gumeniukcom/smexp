<?php
/**
 * @author Stan Gumeniuk i@vigo.su
 */

namespace Vigo5190\Smexp;

use \Doctrine\ORM\Tools\Setup,
    Vigo5190\Smexp\Arch\Arch,
    \Doctrine\ORM\EntityManager,
    \PHPExcel,
    \PHPExcel_IOFactory,
    Vigo5190\Smexp\Xls\XlsRegistrations;

class Smexp {
    /** @var  Array */
    private $db_config;

    /** @var  Array */
    private $archConfig;

    /** @var  Array */
    private $filesConfig;

    /** @var EntityManager */
    private $entityManager;

    /** @var  Arch */
    private $Arch;

    /** @var  Entities\Registration[] */
    private $allRegistrations;

    /** @var  PHPExcel */
    private $Xls;

    /** @var  XlsRegistrations */
    private $Xls2;

    public function __construct(EntityManager $em, Array $config) {
        $this->archConfig = $config['arch'];
        $this->filesConfig = $config['files'];
        $this->entityManager = $em;
    }

    public function getDumpRegistrationsInArch() {
        $this->initArch();
        $this->initAllRegistrations();
        $this->initXls();
        $this->setAllRegistrationsToXls();
        $this->dumpXlsWithAllRegistrationsToFile();
        $this->dumpUploads();
        $this->zipArch();

        $this->getZipArch();




    }

    private function getZipArch(){
        if (file_exists($this->Arch->getZipArchPath())) {

            header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
            header("Cache-Control: public"); // needed for i.e.
            header("Content-Type: archive/zip");
            header("Content-Transfer-Encoding: Binary");
            header("Content-Length:".filesize($this->Arch->getZipArchPath()));
            header("Content-Disposition: attachment; filename=file.zip");
            readfile($this->Arch->getZipArchPath());
        } else {
            die("Error: File not found.");
        }
    }

    private function initAllRegistrations() {
        /** @var Repositories\RegistrationRepository $RegistrationsRepository */
        $RegistrationsRepository = $this->entityManager->getRepository('\\Vigo5190\\Smexp\\Entities\\Registration');
        $this->allRegistrations = $RegistrationsRepository->findAll();
    }

    private function initArch() {
        $this->Arch = new Arch($this->archConfig['dir']);
    }

    private function zipArch(){
        $this->Arch->zip();
    }


    private function initXls() {

        $this->Xls2 = new XlsRegistrations();

//        $this->Xls = new \PHPExcel();
//
//
//        $this->Xls->getProperties()->setCreator("user")
//                  ->setLastModifiedBy("username")
//                  ->setTitle("Title")
//                  ->setSubject("Название.")
//                  ->setDescription("Описание")
//                  ->setKeywords("php, all results")
//                  ->setCategory("some category");
//
//        $this->Xls->getDefaultStyle()->getFont()
//                  ->setName('Arial')
//                  ->setSize(10);
//
//        $this->Xls->getActiveSheet()->setTitle('Regs');
//        $this->Xls->setActiveSheetIndex(0);
    }

    private function setAllRegistrationsToXls() {
//        $data = [];
//        $i = 1;
//        /** @var Entities\Registration $reg */
//        foreach ($this->allRegistrations as $reg) {
//            $j = 1;
//                $data[$i] = [
//                    $j++ => $reg->getId(),
//                    $j++ => $reg->getSomedata1(),
//                    $j++ => $reg->getName(),
//                    $j++ => $reg->getSecondName(),
//                    $j++ => $reg->getLastName(),
//                    $j++ => $reg->getBirthday()->format("Y-m-d"),
//                    $j++ => $reg->getPhone(),
//                    $j++ => $reg->getEmail(),
//                    $j++ => $reg->getCity(),
//                    $j++ => $reg->getImei(),
//                    $j++ => $reg->getModel(),
//                    $j++ => $reg->getDateBuy()->format("Y-m-d"),
//                    $j++ => $reg->getCity(),
//                    $j++ => $reg->getImgPath(),
//
//                ];
//            $i++;
////            $j='A';
////            $this->Xls->setActiveSheetIndex(0)
////                      ->setCellValue($j++.$i, $reg->getId())
////                      ->setCellValue($j++.$i, $reg->getSomedata1())
////                      ->setCellValue($j++.$i, $reg->getName())
////                      ->setCellValue($j++.$i, $reg->getSecondName())
////                      ->setCellValue($j++.$i, $reg->getLastName())
////                      ->setCellValue($j++.$i, $reg->getBirthday()->format("Y-m-d"))
////                      ->setCellValue($j++.$i, $reg->getPhone())
////                      ->setCellValue($j++.$i, $reg->getEmail())
////                      ->setCellValue($j++.$i, $reg->getCity())
////                      ->setCellValue($j++.$i, $reg->getImei())
////                      ->setCellValue($j++.$i, $reg->getModel())
////                      ->setCellValue($j++.$i, $reg->getDateBuy()->format("Y-m-d"))
////                      ->setCellValue($j.$i, $reg->getImgPath());
////
////            $this->Xls->getActiveSheet()
////                      ->getCell("M".$i++)->getHyperlink()->setUrl($reg->getImgPath());
//        }

        $this->Xls2->setData($this->allRegistrations);

    }

    private function dumpXlsWithAllRegistrationsToFile() {
        $fileNameWithOutExt = $this->Arch->getTempDir() . '/' . 'registrations';
        $this->Xls2->dumpXlsToFile($fileNameWithOutExt);
//        $objWriter = PHPExcel_IOFactory::createWriter($this->Xls, 'Excel2007');
//        $filename = $this->Arch->getTempDir() . '/' . 'registrations.xlsx';
//        $objWriter->save($filename);
    }


    private function dumpUploads(){
        /** @var Entities\Registration $reg */
        foreach ($this->allRegistrations as $reg) {
            copy(
                $this->filesConfig['files']."/".$reg->getImgPath(),
                $this->Arch->getTempDir().'/'.$reg->getImgPath()
            );
        }

    }
} 