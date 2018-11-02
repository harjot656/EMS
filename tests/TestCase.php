<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

       public function addEmployee(){
    	if($this->flushSession() ){
    		$this->assertTrue(true);
    	}else{
              	$this->assertTrue(false);	
    	}
        
    }
}
