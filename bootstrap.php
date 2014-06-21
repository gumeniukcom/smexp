<?php
/**
 * @author Stan Gumeniuk i@vigo.su
 */

use \Doctrine\ORM\Tools\Console\ConsoleRunner,
    \Doctrine\ORM\Tools\Setup,
    \Doctrine\ORM\EntityManager;

date_default_timezone_set('UTC');
error_reporting(E_ALL);

function exception_error_handler($errno, $errstr, $errfile, $errline) {
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");

$config = require_once "config.php";

$conn = $config['db'];

$isDevMode = true;
$paths = [
    __DIR__ . "/src/Vigo5190/Smexp/yaml"
];
$metadataConfig = Setup::createYAMLMetadataConfiguration($paths, $isDevMode);

$entityManager = EntityManager::create($conn, $metadataConfig);


