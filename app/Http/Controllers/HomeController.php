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
use Carbon\Carbon;
use DateTime;

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
        
        $reference = $database->get_database()->getReference('employee');
        
        $snapshot = $reference->getSnapshot();
        $value = $snapshot->getValue();
        $value = $reference->getValue(); 
        
        $last_employee_id = end($value);
        $data['last_employee_id'] = isset($last_employee_id['last_numeric_employee_id'])?$last_employee_id['last_numeric_employee_id']:$last_employee_id['employee_id'];
        if($data['last_employee_id'] >1000){
            $data['last_employee_id'] = $data['last_employee_id'] + 1;
        }else{
           $data['last_employee_id'] = 1000 + (isset($last_employee_id['last_numeric_employee_id'])?$last_employee_id['last_numeric_employee_id']:$last_employee_id['employee_id']); 
        }
        return view('index',array('data'=>$value,'last_numeric_employee_id'=>$data['last_employee_id']));
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
    public function generateReport(Request $request){
        $database  = new FirebaseDb;
        $reference = $database->get_database()->getReference('employee');
        $snapshot = $reference->getSnapshot();
        $data['value'] = $snapshot->getValue();
       for ($m=1; $m<=date('m'); $m++) {
         $data['date'][] = date('F', mktime(0,0,0,$m, 1, date('Y')));
         
         }
         $daat['currently_selected'] = date('Y');
         $data['earliest_year'] = 1950;
         $data['latest_year'] = date('Y'); 
         
        return view('generate_report')->with('data',$data);
    }

    public function get_report(Request $request){
    	$dataa = $request->all();        
	    $data =  array();
	    parse_str($dataa['param1'], $data);
     //     echo "<pre>";print_r($myValue);die;
	    // print_r($myValue);
    	$date_arr =[];
        if((isset($data['from_date']) && $data['from_date']!='') && (isset($data['to_date']) && $data['to_date']!='')){  //////////////If User Has Selected From and To Date
            $date_from = strtotime($data['from_date']);   
            $date_to = strtotime($data['to_date']);
            for ($i=$date_from; $i<=$date_to; $i+=86400) {  
                $date_arr[] = date("d-m-Y", $i);  
            }
        }else if(isset($data['week']) && $data['week']!=''){  //////////  For Range of week 
            $arr = explode(' ',$data['week']);
            if($arr[0]==$arr[2]){
             $date_arr[] = $arr[0];   
            }else{
                $date_from = strtotime($arr[0]);   
                $date_to = strtotime($arr[2]);
                for ($i=$date_from; $i<=$date_to; $i+=86400) {  
                    $date_arr[] = date("d-m-Y", $i);  
                }
            }    
            // $pos = strrpos($request->week, ' ');
            // $first = substr($string, 0, $pos);
            // $second = substr($string, $pos + 1)

        }else if(isset($data['month_by']) && $data['month_by']!=''){  //////////  For Entire Month
            $year = date('Y');
            $monthname =  $data['month_by'];
            $monthnum = date("n", strtotime("01-".$monthname."-2011 00:00:00"));
            for($d=1; $d<=31; $d++)
			{
			    $time=mktime(12, 0, 0, $monthnum, $d, $year);          
			    if (date('m', $time)==$monthnum)       
			        $date_arr[] = date('d-m-Y', $time);
			}
        }else if(isset($data['year']) && $data['year']!=''){
        	if($data['year'] ==date('Y')) $number = date('n',strtotime(date('d-m-Y')));else $number = 12;
        	for ($i=1; $i <=$number; $i++) { 
        		for ($j=1; $j <=31; $j++) { 
        			$time=mktime(12, 0, 0, $i, $j, $data['year']);          
			    	if (date('m', $time)==$i)       
			        $date_arr[] = date('d-m-Y', $time);
        		}
        	}
        }
        // echo "<pre>";print_r($request->all());die;
        if($data['report_by'] =='all_employees'){
        	
            $database  = new FirebaseDb;
            $reference = $database->get_database()->getReference('employee');
            $snapshot = $reference->getSnapshot();
            $data['employee_list'] = $snapshot->getValue();
            $reference2 = $database->get_database()->getReference('employee_attendance');
            $snapshot2 = $reference2->getSnapshot()->getValue();
			$i = 0;
            $present = 0;         
			foreach($snapshot2 as $key=>$value){
				foreach ($date_arr as $keyy => $valuee){
					//echo"<pre>";print_r($value);die;
					if(array_key_exists($valuee, $value)){
            		$present = $present + 1;
            		$attendance_arr[$i]['date'] = $valuee;
            		$attendance_arr[$i]['in_time'] = $value[$valuee]['in-time'];
            		$attendance_arr[$i]['out_time'] = $value[$valuee]['out-time'];
            		$attendance_arr[$i]['status'] = $value[$valuee]['status'];
            		$attendance_arr[$i]['shift_hours'] = $value[$valuee]['shift_hours'];
            		$attendance_arr[$i]['comments'] = $value[$valuee]['comments'];
            	}else{
            		$attendance_arr[$i]['date'] = $valuee;
            		$attendance_arr[$i]['in_time'] = '-';
            		$attendance_arr[$i]['out_time'] = '-';
            		$attendance_arr[$i]['status'] = '-';
            		$attendance_arr[$i]['shift_hours'] = '-';
            		$attendance_arr[$i]['comments'] = '-';
            	}
				$i++;
				}
				
			}
			echo "<pre>";print_r($attendance_arr);die;
            foreach($data['employee_list'] as $key=>$value){
             if(array_key_exists($value['employee_id'], $snapshot2)){
               $employee_attendance_arr[] =  $snapshot2[$value['employee_id']];
               // echo "<pre>";

             }
            }
            echo "In If";
            die;
            // print_r($request->all());
            // print_r($data);
            // print_r($snapshot2);
            // die;
        }
        else if(isset($data['report_byy']) && $data['report_byy']!='')
        {
        	$employee_detail = [];
        	$database  = new FirebaseDb;
            $reference = $database->get_database()->getReference('employee');
            $snapshot = $reference->getSnapshot();
            $data['employee_list'] = $snapshot->getValue();
            $reference2 = $database->get_database()->getReference('employee_attendance/'.$data['report_byy'].'');
            $data['employee_attendance'] = $reference2->getSnapshot()->getValue();
             foreach($data['employee_list'] as $key=>$value){
				 if($value['employee_id'] ==$data['report_byy']){
					 $employee_detail = $value;
				 }
			 }
  //           echo "<pre>";
//             print_r($employee_detail);die;
            $i = 0;
            $present = 0;
            foreach ($date_arr as $key => $value) {
            	$j=0;
            	if(array_key_exists($value, $data['employee_attendance'])){
            		$present = $present + 1;
            		$attendance_arr[$i]['date'] = $value;
            		$attendance_arr[$i]['in_time'] = $data['employee_attendance'][$value]['in-time'];
            		$attendance_arr[$i]['out_time'] = $data['employee_attendance'][$value]['out-time'];
            		$attendance_arr[$i]['status'] = $data['employee_attendance'][$value]['status'];
            		$attendance_arr[$i]['shift_hours'] = $data['employee_attendance'][$value]['shift_hours'];
            		$attendance_arr[$i]['comments'] = $data['employee_attendance'][$value]['comments'];
            	}else{
            		$attendance_arr[$i]['date'] = $value;
            		$attendance_arr[$i]['in_time'] = '-';
            		$attendance_arr[$i]['out_time'] = '-';
            		$attendance_arr[$i]['status'] = '-';
            		$attendance_arr[$i]['shift_hours'] = '-';
            		$attendance_arr[$i]['comments'] = '-';
            	}
            	$i++;
            }
            // echo "<pre>";print_r($attendance_arr);die;
            // echo $present.' '.count($date_arr);die;
            if($present !=0){
            	if(isset($data['month_by']) && $data['month_by']!=''){
            	$attendance_arr['monthly_average'] = ceil($present/(count($date_arr)));            		
            	}else if(isset($data['year']) && $data['year']!=''){
            	$attendance_arr['yearly_average'] = ceil($present/(count($date_arr)));	
            	}
            	
            }
            $html='';
            $html.="<div class='content container-fluid'><div class='row'><div class='col-lg-12'> <div class='col-md-2 user-info'><h3>Name:".$employee_detail['first_name']." ".$employee_detail['last_name']."</h3></div><div class='col-md-2 user-info'><h3>Avrage Hours</h3></div> </div><div class='col-lg-12'><div class='table-responsive'><table class='table table-striped custom-table m-b-0'><thead><tr><th>Date</th><th>Status</th><th>In-Time</th><th>Out-Time</th><th>Shift Hours</th><th>Comments</th></tr></thead><tbody><tr><td></td><td ></td><td></td><td></td><td></td><td></td></tr></tbody></table></div><div class='table-responsive' style='height: 400px;'><table class='table table-striped custom-table m-b-0'><tbody>";
				foreach($attendance_arr as $key=>$value){

					$html.="<tr><td>".$value['date']."</td><td title=".ucwords($value['status']).">".ucwords($value['status'])."</td><td title='".ucwords($value['in_time'])." ' >".ucwords($value['in_time'])."</td><td title='".ucwords($value['out_time'])."'>".ucwords($value['out_time'])."</td><td>".$value['shift_hours']."</td><td>".$value['comments']."</td></tr>";
				}
				$html.="</tbody></table></div></div></div></div>";							
            return $html;   
        }
        echo "<pre>";print_r($request->all());die;
    }
    public function saveEmployee(Request $request){
            
         $database  = new FirebaseDb;
        
        // echo "<pre>";print_r($request->all());
        // die;
        $reference = $database->get_database()->getReference('employee');
        
            
        $postData  =   [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'employee_id' => $request->employee_id,
            'joining_date' => $request->joining_date,
            'phone' => $request->phone,
            'designation' => $request->designation,
            'last_numeric_employee_id' =>$request->last_numeric_employee_id
        ];
        
        $reference->push($postData);
        
                 return redirect('index');
    }

    public function editEmployee(Request $request){
        $database  = new FirebaseDb;
        // echo "<pre>";print_r($request->all());
        // die;
        $reference = $database->get_database()->getReference('employee/'.$request->node.'')->set([
                       'first_name' => $request->first_name,
                       'last_name'=>$request->last_name,
                       'email'=>$request->email,
                       'employee_id'=>$request->employee_id,
                       'joining_date'=>$request->joining_date,
                       'designation'=>$request->designation,
                       'phone'=>$request->phone,
                       'last_numeric_employee_id' =>$request->last_numeric_employee_id
                      ]);
        if($reference){
            return redirect()->back()->with('success','Employee edited successfully');
        }else{
            return redirect()->back()->with('error','Error while editing');
        }
        // $reference = $database->get_database()->getReference('employee/'.$request->node.'');

    }

    public function removeEmployee(Request $request){
        $database  = new FirebaseDb;
        $reference = $database->get_database()->getReference('employee/'.$request->param1.'')->remove();
        if($reference){
            return "1";
        }
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
        
        $reference = $database->get_database()->getReference('employee');
        
        $snapshot = $reference->getSnapshot();
        $value = $snapshot->getValue();

        $reference2 = $database->get_database()->getReference('employee_attendance');
        $snapshot2 = $reference2->getSnapshot();
        $employee_attendance = $snapshot2->getValue();

        $list=array();
        $month = date('m');
        $year = date('Y');

        for($d=0; $d<31; $d++)
        {
            $time=mktime(12, 0, 0, $month, $d, $year);          
            if (date('m', $time)==$month)       
                $data['list_date'][]=date('d-m-Y', $time);
                $data['attendance'][]=0;
               
        }


        $data['number_days'] = date('t');
        $data['value'] = $value;
        $data['employee_attendance'] = $employee_attendance;
        foreach ($data['value'] as $key => $value) {
           foreach ($data['employee_attendance'] as $keyy => $valuee) {
               if($value['employee_id'] == $keyy){
                $data['value'][$key]['attendance'] = $valuee;
               }
           }
        }
        // echo "<pre>";print_r($data['value']);
        // die;
        $date = date('d-m-Y');
    	// $date = '2018-10-12';
		// parse about any English textual datetime description into a Unix timestamp 
		$ts = strtotime($date);
		// calculate the number of days since Monday
		$dow = date('w', $ts);
		$offset = $dow - 1;
		if ($offset < 0) {
		    $offset = 6;
		}
		// calculate timestamp for the Monday
		$ts = $ts - $offset*86400;
		// loop from Monday till Sunday 
		for ($i = 0; $i < 7; $i++, $ts += 86400){
		    $data['date'][] =  date("d-m-Y", $ts);
		}
		// echo "<pre>";print_r($data['date']);
		// die;
        return view('add_attendance')->with('data',$data);
    }

    public function addAttendance2(Request $request){
        
        $database  = new FirebaseDb;
        
        $reference = $database->get_database()->getReference('users');
        
        $snapshot = $reference->getSnapshot();
        $value = $snapshot->getValue();

        $reference2 = $database->get_database()->getReference('employee_attendance');
        $snapshot2 = $reference2->getSnapshot();
        $employee_attendance = $snapshot2->getValue();

        $list=array();
        if($request->date!=''){
            $month = date('m',strtotime($request->date));
            $year = date('Y',strtotime($request->date));    
        }else{
            $month = date('m');
            $year = date('Y');
        }
        

        for($d=0; $d<31; $d++)
        {
            $time=mktime(12, 0, 0, $month, $d, $year);          
            if (date('m', $time)==$month)       
                $data['list_date'][]=date('d-m-Y', $time);
                $data['attendance'][]=0;
               
        }


        $data['number_days'] = date('t');
        $data['value'] = $value;
        $data['employee_attendance'] = $employee_attendance;
        foreach ($data['value'] as $key => $value) {
           foreach ($data['employee_attendance'] as $keyy => $valuee) {
               if($value['employee_id'] == $keyy){
                $data['value'][$key]['attendance'] = $valuee;
               }
           }
        }
        // echo "<pre>";print_r($data['value']);
        // die;
        $date = date('d-m-Y');
        // $date = '2018-10-12';
        // parse about any English textual datetime description into a Unix timestamp 
        $ts = strtotime($date);
        // calculate the number of days since Monday
        $dow = date('w', $ts);
        $offset = $dow - 1;
        if ($offset < 0) {
            $offset = 6;
        }
        // calculate timestamp for the Monday
        $ts = $ts - $offset*86400;
        // loop from Monday till Sunday 
        for ($i = 0; $i < 7; $i++, $ts += 86400){
            $data['date'][$i]['date'] =  date("d-m-Y", $ts);
            $data['date'][$i]['name'] =  date("l", $ts);
        }
        $sunday = Carbon::now()->endOfWeek();
        $last_date = date('d-m-Y',strtotime($sunday));
        $prev_week_sunday = date('d-m-Y',strtotime("last sunday,".$last_date.""));
        $prev_week_monday = date('d-m-Y',strtotime("last Monday,".$prev_week_sunday.""));

        $data['last_date'] = $last_date;
        $data['prev_week_sunday'] = $prev_week_sunday;
        $data['prev_week_monday'] = $prev_week_monday;
        // echo "<pre>";print_r($data);
        // die;
        return view('add_attanance2')->with('data',$data);
    }


    public function saveAttendance(Request $request){
    		$database  = new FirebaseDb;

    	    $data = $request->all();  
            if(($data['status'] == 'absent') || ($data['status'] == 'sick') ||($data['status'] == 'vacation')){
                 $validator = Validator::make($data, [
                            'date' => 'required',
                            // 'comments' =>'required'
                        ]);
            if ($validator->fails())
                {
                    return Response::json(array(
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray()

                    ), 400);
                    //return response()->json(['errors'=>$validator->errors()->all()]);
                }else{
                    $in_time = '';$out_time = '';
                    $reference = $database->get_database()->getReference('employee_attendance/'.$data['employee_id'].'/'.$data['date'].'')->set([
                           'name' => 'Attendance',
                           'in-time'=>$in_time,
                           'out-time'=>$out_time,
                           'comments'=>(isset($data['comments']) && $data['comments']!='')?$data['comments']:'',
                           'shift_hours'=>'',
                           'status'=>$data['status']
                          ]);
                    if($reference){
                        return '1';
                    }
                }     

            }else{
                $validator = Validator::make($data, [
                            'date' => 'required',
                            'in_time' => 'required',
                            'out_time' => 'required',
                            'comments' =>'required',
                            'total_time'=>'required',
                        ]);
                if ($validator->fails())
                {
                    return Response::json(array(
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray()

                    ), 400);
                    //return response()->json(['errors'=>$validator->errors()->all()]);
                }
                else
                {
                   
                    $in_time = $data['in_time'];
                    $out_time = $data['out_time'];
                    $reference = $database->get_database()->getReference('employee_attendance/'.$data['employee_id'].'/'.$data['date'].'')->set([
                           'name' => 'Attendance',
                           'in-time'=>date('d-m-Y').' '.$in_time,
                           'out-time'=>date('d-m-Y').' '.$out_time,
                           'comments'=>$data['comments'],
                           'shift_hours'=>$data['total_time'],
                           'status'=>$data['status']
                          ]);
                    if($reference){
                        return '1';
                    }
                }
            }     
		    // $myValue=  array();
		    // parse_str($data['param1'], $myValue);
		 
		    // $myValue['attendance_date'] = str_replace('/', '-', $myValue['attendance_date']);
		    

		   
    }

    public function getTime(Request $request){
        // echo "<pre>";print_r($request->all());
        //$date = strtotime($request->start);
        
        $dateDiff = intval((strtotime($request->end)-strtotime($request->start))/60);

        $hours = intval($dateDiff/60);
        $minutes = $dateDiff%60;
       // echo $hours .' '.$minutes;
        $time='';
        if($hours >0 && $minutes>0){
            $time = $hours.' hours '.$minutes.' minutes';
        }else if($hours >0 && $minutes<=0){
            $time = $hours.' hours';
        }else if($minutes>0 && $hours<=0){
            $time = $minutes.' minutes';
        }else if($minutes==0 && $hours==0){
            $time = $hours.' hours'.$minutes.' minutes';
        }
        return $time;
    }

    public function prevNextWeek(Request $request){
      
        $end = $request->last_date;
        
        $earlier = new DateTime($end);



        if($request->week =='next_week'){
            $prev_week_sunday = date('d-m-Y',strtotime("last sunday,".$end.""));
            $prev_week_monday = date('d-m-Y',strtotime("last Monday,".$prev_week_sunday.""));

            $next_week_date = date('d-m-Y',strtotime("next sunday,".$end.""));
            $later = new DateTime($next_week_date);
            $diff = $later->diff($earlier)->format("%a");

             $date = $next_week_date;
            // $date = '2018-10-12';
            // parse about any English textual datetime description into a Unix timestamp 
            $ts = strtotime($date);
            // calculate the number of days since Monday
            $dow = date('w', $ts);
            $offset = $dow - 1;
            if ($offset < 0) {
                $offset = 6;
            }
            // calculate timestamp for the Monday
            $ts = $ts - $offset*86400;
            // loop from Monday till Sunday 
            for ($i = 0; $i < 7; $i++, $ts += 86400){
                $data['date'][$i]['date'] =  date("d-m-Y", $ts);
                $data['date'][$i]['name'] =  date("l", $ts);
            }
            $data['employee_id'] = $request->employee_id;
            $data['employee_name'] = $request->employee_name;
            $data['last_date'] = $next_week_date;
            $data['prev_week_sunday'] = $prev_week_sunday;
            $data['prev_week_monday'] = $prev_week_monday;
            return $this->make_dynamic_div($data);
        }else if($request->week == 'prev_week'){
            $prev_week_sunday  = date('d-m-Y',strtotime("last Sunday,".$end.""));
            $prev_week_monday = date('d-m-Y',strtotime("last Monday,".$prev_week_sunday.""));
            $next_monday = date('d-m-Y',strtotime("last Monday,".$end.""));
            $date = $prev_week_sunday;
            $ts = strtotime($date);
            $dow = date('w', $ts);
            $offset = $dow - 1;
            if ($offset < 0) {
                $offset = 6;
            }
            $ts = $ts - $offset*86400;
            // loop from Monday till Sunday 
            for ($i = 0; $i < 7; $i++, $ts += 86400){
                $data['date'][$i]['date'] =  date("d-m-Y", $ts);
                $data['date'][$i]['name'] =  date("l", $ts);
            }
            $data['employee_id'] = $request->employee_id;
            $data['employee_name'] = $request->employee_name;
            $data['last_date'] = $prev_week_sunday;
            $data['prev_week_sunday'] = $prev_week_sunday;
            $data['prev_week_monday'] = $prev_week_monday;
            return $this->make_dynamic_div($data);
        }
    }


    public function make_dynamic_div($data){
        $list_arr = array('present','absent','sick','vacation','weekend');
        
        $html= "<div class=table-responsive><table class='table table-striped custom-table m-b-0'><thead><tr><th id='name_employee_id'><h4>".$data['employee_name']."</h4><h6>Employee ID: ".$data['employee_id']."</h6></th>";
        foreach($data['date'] as $key=>$value){
            $html .="<th><h5>".$value['date']."</h5><h6>".$value['name']."</h6></th>";
        }
        $html.="</tr></thead><tbody><tr><td>Status:</td>";
       foreach($data['date'] as $key=>$value){
                $dynamic_atten = $this->getDynamicAttendance($data,$value['date']);
                if(!empty($dynamic_atten)){

                            $html .="<td><div class='form-focus select-focus'><label class='control-label'></label><select class='select'  name=status_presence#".$value['date']."><option value=''>--Select--</option>";
                            for($i=0;$i<5;$i++){
                                if(trim(strtolower($dynamic_atten['status'])) == $list_arr[$i]){
                                    $selected ='selected = selected';
                                }else{
                                    $selected = '';
                                }
                                $html.='<option value ='.$list_arr[$i].' '.$selected.'>'.ucwords($list_arr[$i]).'</option>';
                            }
                            $html.='</select></div></td>';
                }else{
                      $html .="<td><div class='form-focus select-focus'><label class='control-label'></label><select class='select'  name=status_presence#".$value['date']."><option value=''>--Select--</option><option value=present>Present</option><option value=absent>Absent</option><option value=sick>Sick</option><option value=vacation>Vacation</option><option value=weekend>Weekend</option></select></div></td>";
                }
              
            }
        $html.="</tr><tr><td>TimeIn:</td>";
        foreach($data['date'] as $key=>$value){
            $dynamic_atten = $this->getDynamicAttendance($data,$value['date']);
            if(!empty($dynamic_atten)){
                // echo "<pre>";print_r($dynamic_atten);die;
               $html .="<td><div class='form-focus select-focus'><label class='control-label'></label><input class='time_select in_time' id=in_time#".$value['date']."  name=in_time#".$value['date']." value='".$dynamic_atten['in_time']."'  type=text placeholder=''></div></td>"; 
            }else{
             $html .="<td><div class='form-focus select-focus'><label class='control-label'></label><input class='time_select in_time' id=in_time#".$value['date']."  name=in_time#".$value['date']."  type=text placeholder=''></div></td>";
            }
        }
        $html.="</tr><tr><td>TimeOut:</td>";
        foreach($data['date'] as $key=>$value){
            $dynamic_atten = $this->getDynamicAttendance($data,$value['date']);
            if(!empty($dynamic_atten)){
                $html .="<td><div class='form-focus select-focus'><label class='control-label'></label><input class='time_select out_time' id=out_time#".$value['date']." name=out_time#".$value['date']." value='".$dynamic_atten['out_time']."'  type=text placeholder=''></div></td>";
            }else
            {
             $html .="<td><div class='form-focus select-focus'><label class='control-label'></label><input class='time_select out_time' id=out_time#".$value['date']." name=out_time#".$value['date']."   type=text placeholder=''></div></td>";
            }
        }
        $html.="</tr><tr><td>TotalHrs:</td>";
        foreach($data['date'] as $key=>$value){
            $dynamic_atten = $this->getDynamicAttendance($data,$value['date']);
            if(!empty($dynamic_atten)){
                $html .="<td><div class='form-focus select-focus'><label class='control-label'></label><input class='time_select' id=total_time#".$value['date']." name=total_time#".$value['date']." value='".$dynamic_atten['shift_hours']."' readonly  type=text placeholder=''></div></td>";
            }else{
            $html .="<td><div class='form-focus select-focus'><label class='control-label'></label><input class='time_select' id=total_time#".$value['date']." name=total_time#".$value['date']." readonly  type=text placeholder=''></div></td>";
                
            }
        }
        $html.="</tr><tr><td>Comment:</td>";
        foreach($data['date'] as $key=>$value){
            $dynamic_atten = $this->getDynamicAttendance($data,$value['date']);
            if(!empty($dynamic_atten)){
                $html .="<td><div class='form-focus select-focus'><label class='control-label'></label><input class=time_select id=comments#".$value['date']." name=comments#".$value['date']." value='".$dynamic_atten['comments']."'   type=text placeholder=''></div></td>";
            }else{    
            $html .="<td><div class='form-focus select-focus'><label class='control-label'></label><input class=time_select id=comments#".$value['date']." name=comments#".$value['date']."   type=text placeholder=''></div></td>";
            }
        }
        $html.="</tr>";
        $html.="<tr><td></td>";
        foreach($data['date'] as $key=>$value){
            echo "<pre>";print_r($value);die;
            if(strtotime($value['date'])>strtotime(date('d-m-Y'))){
                echo "Here";
                $disabled="disabled";
            }else{
                $disabled = '';
            }
            $html .="<td><div class=''><button class='btn btn2 btn-primary submit' ".$disabled." name='submit' id=submit#".$value['date']."  name=submit#".$value['date'].">Save</button></div></td>";
        }
        $html.="<input type=hidden name=employee_id id=employee_id value=".$data['employee_id']."><input type=hidden name=employee_name id=employee_name value=".$data['employee_name']."><input type=hidden name=last_date id=last_date value=".$data['last_date']."><input type=hidden name=prev_week_sunday id=prev_week_sunday value=".$data['prev_week_sunday']."><input type=hidden name=prev_week_monday id=prev_week_monday value=".$data['prev_week_monday']."></tr></tbody></table></div>";
        return $html;                                   
    }


    public function getDynamicAttendance($data,$date){
        $list_arr = array('present','absent','sick','vacation','weekend');
        
        $database  = new FirebaseDb;
        $reference = $database->get_database()->getReference('employee_attendance/'.$data['employee_id'].'/'.$date.'');
        $snapshot = $reference->getSnapshot();
        $employee_attendance = $snapshot->getValue();
        // echo "<pre>";print_r($employee_attendance);
        // die;
        if(!empty($employee_attendance)){
                $arr_in_time = explode(" ",$employee_attendance['in-time']);
                $arr_out_time = explode(" ",$employee_attendance['out-time']);
                $returndata['in_time'] = $arr_in_time[1].' '.$arr_in_time[2];
                $returndata['out_time'] = $arr_out_time[1].' '.$arr_out_time[2];
                $returndata['status'] = !isset($employee_attendance['status'])?'N/A':$employee_attendance['status'];
                $returndata['comments'] = $employee_attendance['comments'];
                $returndata['shift_hours'] = !isset($employee_attendance['shift_hours'])?'0 hours':$employee_attendance['shift_hours'];

            return $returndata;

           // echo "<pre>"; print_r($returndata);die;
        }else{
            return array();
        }
        
    }
}
