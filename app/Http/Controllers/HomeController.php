<?php

namespace App\Http\Controllers;

/*
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
*/

use Kreait\Firebase;

use Kreait\Firebase\Factory;

use Kreait\Firebase\ServiceAccount;

use Kreait\Firebase\Database;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    

    public function index(){
   
try{
    
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/ems-php-7be99-008e26379391.json');

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
    
    }
    public function login(Request $request){
        return redirect('index');
    }
    public function showIndex(Request $request){
        return view('index');
    }
    public function holiday(Request $request){
        return view('holidays');
    }
    public function leaveRequest(Request $request){
        return view('leave_request');
    }
    public function showAttendance(Request $request){
        return view('attendance');
    }
    public function showDepartment(Request $request){
        return view('department');
    }
    public function showDesignation(Request $request){
        return view('designation');
    }
    public function getProfile(Request $request){
        return view('profile');
    }
    public function editProfile(Request $request){
        return view('edit_profile');
    }
}
