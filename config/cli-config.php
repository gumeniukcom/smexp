<?php
/**
 * @author Stan Gumeniuk i@vigo.su
 */

use \Doctrine\ORM\Tools\Console\ConsoleRunner,
    \Doctrine\ORM\Tools\Setup;

require_once __DIR__."/../vendor/autoload.php";
$config = require_once __DIR__ . "/../bootstrap.php";



$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($entityManager)
));

return $helperSet;