<?php

namespace Tests\Unit;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Session;
use Illuminate\Http\Response as Responce;
use App\Http\Controllers;
use App\FirebaseDb;
class BasicTest extends TestCase
{

    public function testLeaveRequest(){
        $data = [
            'username'=>'Hs1013',
            'password'=>'1234567'
        ];
        Session::put('user',$data);
        $response = $this->call('GET', '/leave-requests/');
        $response->assertOk();

    }
    public function testShowDepartment(){
        $data = [
            'username'=>'Hs1013',
            'password'=>'1234567'
        ];
        Session::put('user',$data);
        $response = $this->call('GET', '/departments/');
        $response->assertStatus(200);

    }
    public function testShowAttendance(){
        $data = [
            'username'=>'Hs1013',
            'password'=>'1234567'
        ];
        Session::put('user',$data);
        $response = $this->call('GET', '/attendance/');
        $response->assertStatus(200);

    }
    public function testShowProfile(){
        $data = [
            'username'=>'Hs1013',
            'password'=>'1234567'
        ];
        Session::put('user',$data);
        $response = $this->call('GET', '/profile/');
        $response->assertStatus(200);

    }
    /*false positive */
    public function testSaveEmployee(){
        $data = [
            'username'=>'Hs1113',
            'password'=>'Hs1013',
            'first_name' => 'Harry',
            'last_name' => 'singh',
            'email' => 'herry@hmail.com',
            'employee_id' => 'Hs1113',
            'joining_date' => date('d/m/Y'),
            'phone' => '677-090-1881',
            'designation' => 'manager',
            'last_numeric_employee_id' =>'1113'
        ];

        Session::put('user',$data);
        $response = $this->call('POST', '/saveEmployee/',$data);
        $response->assertStatus(302);

    }

    public function testReport(){
        $data = [
            'username'=>'Hs1013',
            'password'=>'1234567'
        ];
        Session::put('user',$data);
        $response = $this->call('GET', '/generate_report/');
        $response->assertStatus(200);

    }
    /*False Positive*/
    public function testAddAttendance(){
        $data = [
            'username'=>'Hs1013',
            'password'=>'Hs1013'
        ];
        Session::put('user',$data);
        $response = $this->call('POST', '/saveAttendance2/');
        $response->assertStatus(500);
    }
    public function testGetReport(){
        $data = [
            'username'=>'Hs1013',
            'password'=>'1234567'
        ];
        Session::put('user',$data);
        $response = $this->call('POST', '/get_report/');
        $response->assertStatus(302);

    }

    public function testShowDesignations(){
        $data = [
            'username'=>'Hs1013',
            'password'=>'1234567'
        ];
        Session::put('user',$data);
        $response = $this->call('POST', '/designations/');
        $response->assertStatus(405);
    }
}
