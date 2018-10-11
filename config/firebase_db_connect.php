<?php

require_once './vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

try{ 
    
    $serviceAccount = ServiceAccount::fromJsonFile('./vendor/ems-php-7be99-008e26379391.json');
    $firebase = (new Factory)->withServiceAccount($serviceAccount)->create();
    $database = $firebase->getDatabase();    
    //print_r($database);
}
catch(Exception $e)
{
  echo 'Caught exception: ',  $e->getMessage(), "\n";
}

?>