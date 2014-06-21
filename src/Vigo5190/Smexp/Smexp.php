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

    /**
     * @return $this
     */
    public function getDumpRegistrationsInArch() {
        $this->initArch();
        $this->initAllRegistrations();
        $this->initXls();
        $this->setAllRegistrationsToXls();
        $this->dumpXlsWithAllRegistrationsToFile();
        $this->dumpUploads();
        $this->zipArch();
        $this->getZipArch();
        return $this;
    }

    /**
     * @return $this
     */
    private function getZipArch() {
        if (file_exists($this->Arch->getZipArchPath())) {
            header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
            header("Cache-Control: public"); // needed for i.e.
            header("Content-Type: archive/zip");
            header("Content-Transfer-Encoding: Binary");
            header("Content-Length:" . filesize($this->Arch->getZipArchPath()));
            header("Content-Disposition: attachment; filename=file.zip");
            readfile($this->Arch->getZipArchPath());
        } else {
            die("Error: File not found.");
        }
        return $this;
    }

    /**
     * @return $this
     */
    private function initAllRegistrations() {
        /** @var Repositories\RegistrationRepository $RegistrationsRepository */
        $RegistrationsRepository = $this->entityManager->getRepository('\\Vigo5190\\Smexp\\Entities\\Registration');
        $this->allRegistrations = $RegistrationsRepository->findAll();
        return $this;
    }

    /**
     * @return $this
     */
    private function initArch() {
        $this->Arch = new Arch($this->archConfig['dir']);
        return $this;
    }

    /**
     * @return $this
     */
    private function zipArch() {
        $this->Arch->zip();
        return $this;
    }

    /**
     * @return $this
     */
    private function initXls() {
        $this->Xls2 = new XlsRegistrations();
        return $this;
    }

    /**
     * @return $this
     */
    private function setAllRegistrationsToXls() {
        $this->Xls2->setData($this->allRegistrations);
        return $this;
    }

    /**
     * @return $this
     */
    private function dumpXlsWithAllRegistrationsToFile() {
        $fileNameWithOutExt = $this->Arch->getTempDir() . '/' . 'registrations';
        $this->Xls2->dumpXlsToFile($fileNameWithOutExt);
        return $this;
    }

    /**
     * @return $this
     */
    private function dumpUploads() {
        /** @var Entities\Registration $reg */
        foreach ($this->allRegistrations as $reg) {
            copy(
                $this->filesConfig['files'] . "/" . $reg->getImgPath(),
                $this->Arch->getTempDir() . '/' . $reg->getImgPath()
            );
        }
        return $this;
    }
} 