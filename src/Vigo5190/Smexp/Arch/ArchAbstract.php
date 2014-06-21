<?php

namespace Vigo5190\Smexp\Arch;

use ZipArchive,
    RecursiveIteratorIterator,
    RecursiveDirectoryIterator;

abstract class ArchAbstract {

    /**
     * @var string
     */
    protected $hash;

    /**
     * @var string
     */
    protected $tempDir;

    /**
     * @var string
     */
    protected $zipPath;

    /**
     * @var ZipArchive
     */
    protected $Zip;

    /**
     *
     */
    const TEMP_PATH = '/tmp';

    public function __construct($tempPath = self::TEMP_PATH) {
        $this->hash = bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM));

        $tempPath = self::clearTempPath($tempPath);
        $this->tempDir = $tempPath . '/' . $this->hash;
        $this->zipPath = $tempPath . '/' . $this->hash . '.zip';

        self::createDir($this->tempDir);
        self::createDir($this->tempDir . '/uploads');
    }

    /**
     * @return string
     */
    public function getHash() {
        return $this->hash;
    }

    /**
     * @return string
     */
    public function getTempDir() {
        return $this->tempDir;
    }

    /**
     * @return string
     */
    public function getZipArchPath() {
        return $this->zipPath;
    }

    /**
     * Архивирование
     */
    public function zip() {
        $this->zipConsole();
    }

    /**
     *
     */
    public function __destruct() {
        try {
            self::rmdir_recursive($this->tempDir);
        } catch (\Exception $e) {
            throw new \ErrorException(
                sprintf('Can\'t delete temp dir %s, because: %s', $this->tempDir, $e->getMessage()),
                $e->getCode(),
                1,
                $e->getFile(),
                $e->getLine(),
                $e
            );
        }
    }

    /**
     * @param $dir
     */
    protected static function rmdir_recursive($dir) {
        foreach (scandir($dir) as $file) {
            if ('.' === $file || '..' === $file) {
                continue;
            }
            if (is_dir("$dir/$file")) {
                self::rmdir_recursive("$dir/$file");
            } else {
                unlink("$dir/$file");
            }
        }
        rmdir($dir);
    }

    /**
     * @param $tempDir
     * @throws \ErrorException
     */
    protected static function createDir($tempDir) {
        try {
            mkdir($tempDir);
        } catch (\Exception $e) {
            throw new \ErrorException(
                sprintf('Can\'t create temp dir %s, because: %s', $tempDir, $e->getMessage()),
                $e->getCode(),
                1,
                $e->getFile(),
                $e->getLine(),
                $e
            );
        }
    }

    /**
     * @param $path
     * @return string
     */
    protected static function clearTempPath($path) {
        $tempPath = trim($path);
        return rtrim($tempPath, "/");
    }

    /**
     * Архив не открывается на Mac OS X
     */
    protected function zipPhp() {
        $this->Zip = new ZipArchive;
        $this->Zip->open($this->zipPath, ZipArchive::CREATE);

        $Files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($this->tempDir),
            RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($Files as $name => $file) {
            $filePath = $file->getRealPath();

            $this->Zip->addFile($filePath);

        }

        $this->Zip->close();
    }

    /**
     * Работает для всех ОС
     */
    private function zipConsole() {
        passthru("cd " . $this->getTempDir() . "/ && zip -0 -q -m -r ../" . $this->getHash() . ".zip .");
    }

} 