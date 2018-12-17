<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Session;
use App\FirebaseDb;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;

class AlphaTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

     public function testLogin(){////////////////////Login TestCase
     	$data = [
     		'username'=>'Hs1013',
     		'password'=>'1234567'
     	];
     	$database  = new FirebaseDb;
    	$reference = $database->get_database()->getReference('admin');
        
        $snapshot = $reference->getSnapshot();
        $value = $snapshot->getValue();
        $incorrect = 0;
        foreach($value as $key => $val)
        {
            if($data['username'] == $val['username'])
            {
                $incorrect = $incorrect + 1;
                if($data['password'] == $val['password'])
                {
                    Session::put('user',$val);
                    $this->assertTrue(true);
                }
                else
                {
                   $this->assertTrue(false);
                } 
            }
        }
        
        if($incorrect ==0)
        {
               $this->assertTrue(true);
        }
    }

    public function testLogout(){  /////////////  Logout TestCase
    	if($this->flushSession() ){
    		$this->assertTrue(true);
    	}else{
              	$this->assertTrue(false);	
    	}
    }

    // public function testEmployee(){///////////// Test Case For Add Employee as well as Manager
    // 	$database  = new FirebaseDb;
    //     $reference = $database->get_database()->getReference('employee');
    //     $reference2 = $database->get_database()->getReference('admin');
    //     $data = array('designation'=>'Associate','username'=>'Harj','password'=>'1234567','first_name'=>'Harj','last_name'=>'Can','email'=>'harcan@gmail.com','employee_id'=>'HC1090','joining_date'=>'02-11-2018','last_numeric_employee_id'=>'101010','phone'=>'9874561230');
    //     if(strtolower(trim($data['designation'])) == 'manager'){
    //         $postData2 = [
    //             'username'=>$data['employee_id'],
    //             'password'=>$data['password']
    //         ];
    //         $reference2->push($postData2);
    //     }
    //     $postData  =   [
    //         'first_name' => $data['first_name'],
    //         'last_name' => $data['last_name'],
    //         'username' => $data['username'],
    //         'email' => $data['email'],
    //         'password' => $data['password'],
    //         'employee_id' => $data['employee_id'],
    //         'joining_date' => $data['joining_date'],
    //         'phone' => $data['phone'],
    //         'designation' => $data['designation'],
    //         'last_numeric_employee_id' =>$data['last_numeric_employee_id']
    //     ];
    //     if($reference->push($postData)){
    //     	$this->assertTrue(true);
        	
    //     }
        
    // }

    public function testEmployeeedit(){   //////////  TestCase for Edit Employee
    	$database  = new FirebaseDb;
    	//4162763524
    	$node = '-LQ9_34mqFLqWzF6uLvX';
    	$data = array('designation'=>'Manager','first_name'=>'Harjot','last_name'=>'Sahota','email'=>"hsaho020@uottawa.ca",'employee_id'=>'HS1022','joining_date'=>'28/10/2018','last_numeric_employee_id'=>'1022','phone'=>'4162763524');

    	$reference = $database->get_database()->getReference('employee/'.$node.'')->set([
                       'first_name' => $data['first_name'],
                       'last_name'=>$data['last_name'],
                       'email'=>$data['email'],
                       'employee_id'=>$data['employee_id'],
                       'joining_date'=>$data['joining_date'],
                       'designation'=>$data['designation'],
                       'phone'=>$data['phone'],
                       'last_numeric_employee_id' =>$data['last_numeric_employee_id']
                      ]);
        if($reference){
            $this->assertTrue(true);
        }else{
            $this->assertTrue(false);
        }
    }

    // public function testAttendancesave(){ ///// TestCase for SaveAttendance
    // 	$database  = new FirebaseDb;
    // 	$in_time = "";
    //     $out_time = "";
    //     $data['employee_id'] = 'ms1015';
    //     $data['date'] = '01-11-2018';
    //     $data['total_time'] = '0 hours';
    //     $data['status'] = 'weekend';

    //     $reference = $database->get_database()->getReference('employee_attendance/'.$data['employee_id'].'/'.$data['date'].'')->set([
    //            'name' => 'Attendance',
    //            'in-time'=>$in_time,
    //            'out-time'=>$out_time,
    //            'comments'=>(isset($data['comments'])&& $data['comments']!='')?$data['comments']:'',
    //            'shift_hours'=>$data['total_time'],
    //            'status'=>$data['status']
    //           ]);
    //     if($reference){
    //         $this->assertTrue(true);
    //     }else{
    //     	$this->assertTrue(false);
    //     }
    // }

    public function testGetattendance(){
    	$database  = new FirebaseDb;
    	$employee = 'all_employees'; /////// if single employee than mention single
    	$employee_id = 1;
    	switch ($employee) {
    		case 'all_employees':
    		$reference = $database->get_database()->getReference('employee_attendance');
    		$snapshot = $reference->getSnapshot();
        	$employee_attendance = $snapshot->getValue();
        	if(!empty($employee_attendance)){
        		$this->assertTrue(true);
        	}else $this->assertTrue(false);	
    		break;
    		case 'single':
    		$reference = $database->get_database()->getReference('employee_attendance/'.$data['employee_id'].'');
    		$snapshot = $reference->getSnapshot();
        	$employee_attendance = $snapshot->getValue();
        	if(!empty($employee_attendance)){
        		$this->assertTrue(true);
        	}else $this->assertTrue(false);
    		break;
    		default:
    			$this->assertTrue(true);
    			break;
    	}
    }
    	
}
