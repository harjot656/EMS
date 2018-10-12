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
use App\FirebaseDb; 
use Validator;
use Response;

class HomeController extends Controller
{
    
    public function index(){
        return redirect('index');
    }
    public function login(Request $request){
        return redirect('index');
    }
    public function showIndex(Request $request){

        $database  = new FirebaseDb;
        
        $reference = $database->get_database()->getReference('users');
        
        $snapshot = $reference->getSnapshot();
        $value = $snapshot->getValue();
        $value = $reference->getValue(); 
        
        
        // echo "<pre>";print_r($value);
        // die;
        return view('index')->with('data',$value);
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
    public function addEmployee(Request $request){
        return view('add_employee');
    }
    public function saveEmployee(Request $request){
        
         $database  = new FirebaseDb;
        
        echo "<pre>";print_r($request->all());
        
        $reference = $database->get_database()->getReference('users');
        
            
        $postData  =   [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'employee_id' => $request->employee_id,
            'joining_date' => $request->joining_date,
            'phone' => $request->phone,
            'designation' => $request->designation
        ];
        
        $reference->push($postData);
        
                 return redirect('index');
    }
    public function performLogin(Request $request){
        
        $database  = new FirebaseDb;
        
        $request->validate([
            'username'=>'required',
            'password'=>'required'
        ]);
        
        $reference = $database->get_database()->getReference('admin');
        
        $snapshot = $reference->getSnapshot();
        $value = $snapshot->getValue();
        
        foreach($value as $key => $val)
        {
            $user = $val['username'];
            $pass = $val['password'];
        }
        
        if($request->username == $val['username'])
        {
            if($request->password == $val['password'])
            {
                return redirect('index');
            }
            else
            {
               return redirect()->back()->withErrors(['errors'=>'Password is incorrect.']);
            } 
        }
        else
        {
               return redirect()->back()->withErrors(['errors'=>'Username does not exist.']);
        }
        
    }

    public function addAttendance(Request $request){
        
        $database  = new FirebaseDb;
        
        $reference = $database->get_database()->getReference('users');
        
        $snapshot = $reference->getSnapshot();
        $value = $snapshot->getValue();
        $value = $reference->getValue();
        $data['number_days'] = date('t');
        $data['value'] = $value;
        // echo "<pre>";print_r($data['value']);
        // die;
        return view('add_attendance')->with('data',$data);
    }

    public function saveAttendance(Request $request){
    	    $data = $request->all();        
		    $myValue=  array();
		    parse_str($data['param1'], $myValue);

		    $validator = Validator::make($myValue, [
	            'attendance_date' => 'required',
	            'in_time' => 'required',
	            'out_time' => 'required',
	            'comments' =>'required'
        	]);
        	if ($validator->fails())
	        {
	        	return Response::json(array(
			        'success' => false,
			        'errors' => $validator->getMessageBag()->toArray()

			    ), 400);
	            //return response()->json(['errors'=>$validator->errors()->all()]);
	        }
		    echo "<pre>";
		    print_r($myValue);
		    die;
    	echo $request->employee_id;
    	die;
    	print_r($request->all());
    	die;
    }
}
