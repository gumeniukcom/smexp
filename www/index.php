<?php
/**
 * @author Stan Gumeniuk i@vigo.su
 */

require_once __DIR__ . "/../vendor/autoload.php";

require_once __DIR__ . "/../bootstrap.php";

$Smexp = new \Vigo5190\Smexp\Smexp($entityManager, $config);

$Smexp->getDumpRegistrationsInArch();