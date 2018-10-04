<?php

ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('display_errors', 1);


use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

try{
    
  $serviceAccount = ServiceAccount::fromJsonFile('ems-php-7be99-008e26379391.json');

$firebase = (new Factory)->withServiceAccount($serviceAccount)->create();
$database = $firebase->getDatabase();

$reference = $database->getReference('Username');
$snapshot = $reference->getSnapshot();

$value = $snapshot->getValue();
// or
$value = $reference->getValue();

die(print_r($value));





}
catch(Exception $e)
{
  echo 'Caught exception: ',  $e->getMessage(), "\n";
}



?>
