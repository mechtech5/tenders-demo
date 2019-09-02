<?php

namespace App\Http\Controllers\Expenses;

use App\Http\Controllers\Controller;
use App\Models\CompMast;
use App\Models\EmployeeMast;
use App\Models\TourStages;
use App\Models\TourStatus;
use App\Models\Tours;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ToursController extends Controller
{ 
		public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    { 
    	$tours = Tours::with('stages.status_info','stages.employee')->get();
      return view('expenses.tours.index',compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$data['logged_emp'] = EmployeeMast::with('user')->where('login_user',auth()->user()->id)->first();
    	$data['companies'] = CompMast::where('tour_enable','1')->get();
      return view('expenses.tours.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$data = $request->validate([
	   			'purpose'	=> 'required',
	   			'company'	=> 'required',
	   			'start_loc'	=> 'required',
	   			'end_loc'	=> 'required',
	   			'advance_amount' => 'required',
	   			'note'	=> 'required',
	   			'emp_id'	=> 'required',
	   		]);
    
    	DB::transaction(function () use ($data) { 
    			$tour = new Tours();
		    	$tour->comp_code = $data['company'];
		    	$tour->emp_id = $data['emp_id'];
		    	$tour->purpose = $data['purpose'];
		    	$tour->adv_amt = $data['advance_amount'];
		    	$tour->start_loc = $data['start_loc'];
		    	$tour->end_loc = $data['end_loc'];
		    	$tour->note = $data['note'];
		    	$tour->save();

		    	$stage = new TourStages();
		    	$stage->tour_id = $tour->id;
		    	$stage->creator_id = User::find(auth()->user()->id)->employee->emp_id; 
		    	$stage->status = 1;  //1 for created status
		    	$stage->save();
			});
		

      return redirect()->route('tours.index')->with('success','Tour created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $tour = Tours::findOrfail($id);
      return view('expenses.tours.edit',compact('tour'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	$data = $request->validate([
	 			'purpose'	=> 'required',
	 			'company'	=> 'required',
	 			'start_loc'	=> 'required',
	 			'end_loc'	=> 'required',
	 			'note'	=> 'required',
	 		]);

	 		return $request->all();
    	$tour = Tours::findOrfail($id);
    	$tour->comp_code = $data['company'];
    	$tour->emp_id = $request->emp_id;
    	$tour->purpose = $data['purpose'];
    	$tour->start_loc = $data['start_loc'];
    	$tour->end_loc = $data['end_loc'];
    	$tour->note = $data['note'];
    	$tour->save();
      return redirect()->route('tours.index')->with('success','Tour Updated Succesfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function show_stages($id)
    { 
    	$actions = $this->display_action_button($id);
    	$tour = Tours::with('stages.status_info','stages.employee','employee','company')->where('id',$id)->first();
    	return view('expenses.tours.stages',compact('tour','employee','actions'));
    }

    public function display_action_button($tour_id){

    	$tour = Tours::with('stages.status_info','employee','company')->where('id',$tour_id)->first();
   		$tour_creator = EmployeeMast::where('emp_id',$tour->emp_id)->first();
    	$latest_stage = $this->return_latest_stage($tour->stages);
    	$management = $this->fetch_management_users($tour_id);
    	$d1 = $management['d1'];
    	$d2 = $management['d2'];
    	$hr = $management['hr'];
    	$tl = $management['tl'];

    	$actions['approve'] = $this->display_approve($d1,$d2,$hr,$tl,$tour_creator,$latest_stage);
    	$actions['delete'] = 	$this->display_delete($d1,$d2,$hr,$tl,$tour_creator,$latest_stage);
    	$actions['hold'] = false;
    	$actions['decline'] =  $this->display_decline($d1,$d2,$hr,$tl,$tour_creator,$latest_stage);
    	$actions['start'] = $this->display_start($d1,$d2,$hr,$tl,$tour_creator,$latest_stage);
    	$actions['end'] = $this->display_end($d1,$d2,$hr,$tl,$tour_creator,$latest_stage);
    	return $actions;
    }

    public function display_approve($d1,$d2,$hr,$tl,$tour_creator,$stage){
    	$x = false;
   		$uid = auth()->user()->id; //logged user ID
   		$d1_id = $d1->login_user; //Y sir logged ID
   		$d2_id = $d2->login_user; //HS Sir logged ID
   		$hr_id = $hr->login_user; //HR logged ID
   		$tl_id = $tl->login_user; //TL logged ID

      //if latest stage is created (1) then only TL and Y sir can approve
    	if(in_array($uid,array($d1_id,$tl_id)) && $stage==1){
  			$x = true;
    	}
    	//if latest stage is TL approval (2) then only Y sir can approve 
    	else if($uid == $d1_id && $stage==2){
    		$x = true;
    	}
    	//if latest stage is YS Sir approval (3) then only HR can approve 
    	else if($uid == $hr_id && $stage==3){
    		$x = true;
    	}
    	//if latest stage is Tour ended (6) then only HS Sir can approve 
    	else if($uid == $d2_id && $stage==6){
    		$x = true;
    	}
    	//if latest stage is HS Sir approved (7) then only HR can approve 
    	else if($uid == $hr_id && $stage==7){
    		$x = true;
    	}
    	return $x;
    }

    public function display_start($d1,$d2,$hr,$tl,$tour_creator,$stage){
    	$x = false;
    	$t_creatorid = $tour_creator->login_user; //Employeee- Creator of tour
   		$uid = auth()->user()->id; //logged user ID
   		$d1_id = $d1->login_user; //Y sir logged ID
   		$d2_id = $d2->login_user; //HS Sir logged ID
   		$hr_id = $hr->login_user; //HR logged ID
   		$tl_id = $tl->login_user; //TL logged ID

      //if latest stage is 'Advance Amount Released' (4) then  any one (TL/Y sir/HR/employee) can stgart tour
    	if(in_array($uid,array($t_creatorid,$d1_id,$hr_id,$tl_id)) && $stage==4){
  			$x = true;
    	}
    	return $x;
    }

    public function display_decline($d1,$d2,$hr,$tl,$tour_creator,$stage){
    	$x = false;
    	$t_creatorid = $tour_creator->login_user; //Employeee- Creator of tour
   		$uid = auth()->user()->id; //logged user ID
   		$d1_id = $d1->login_user; //Y sir logged ID
   		$d2_id = $d2->login_user; //HS Sir logged ID
   		$hr_id = $hr->login_user; //HR logged ID
   		$tl_id = $tl->login_user; //TL logged ID

      //if latest stage is created (1) then  any one (TL/Y sir) can decline tour
    	if(in_array($uid,array($d1_id,$tl_id)) && $stage==1){
  			$x = true;
    	}elseif(in_array($uid,array($d1_id))){ //In any case Y sir can decline it
  			$x = true;
    	}
    	return $x;
    }

     public function display_end($d1,$d2,$hr,$tl,$tour_creator,$stage){
    	$x = false;
    	$t_creatorid = $tour_creator->login_user; //Employeee- Creator of tour
   		$uid = auth()->user()->id; //logged user ID
   		$d1_id = $d1->login_user; //Y sir logged ID
   		$d2_id = $d2->login_user; //HS Sir logged ID
   		$hr_id = $hr->login_user; //HR logged ID
   		$tl_id = $tl->login_user; //TL logged ID

      //if latest stage is tour start (5) then  any one (TL/Y sir/HR/employee) can end tour
    	if(in_array($uid,array($t_creatorid,$d1_id,$hr_id,$tl_id)) && $stage==5){
  			$x = true;
    	}
    	return $x;
    }

    public function display_delete($d1,$d2,$hr,$tl,$tour_creator,$stage){
    	$x = false;
    	$employees = array($d1->login_user,$tl->login_user,$tour_creator->login_user);
    	//if latest stage is created then to director and tl and employee
    	if(in_array(auth()->user()->id, $employees) && $stage==1){
    		$x = true;
    	}
    	return $x;
    }

    public function return_latest_stage($stages){
			$index = -1;  //-1 because the index can be 0
			foreach($stages as $key=>$value){
				if($index < $value->id){
					$index = $key;
				}
			}
			return $index < 0 ? 'NULL' : $stages[$index]->status_info->id;
    }	
    //approving tour
    public function approve($id){
    	$tour = Tours::with('stages.status_info','employee','company')->where('id',$id)->first();
    	$latest_stage = $this->return_latest_stage($tour->stages);
    	$management = $this->fetch_management_users($id);
    	$d1 = $management['d1'];
    	$d2 = $management['d2'];
    	$hr = $management['hr'];
    	$tl = $management['tl'];
    	$inserted = false;
    	//Tl, HR, Y Sir , HS Sir can approve the tour but levels are different for more accurate results aslo check current latest stage
    	if($latest_stage == 1){  //created 
				$stage = new TourStages();

				if($d1->login_user == auth()->user()->id){   // If Y sir is approving then skip TL approval step
					$stage->status = 3; //YS Sir approving
				}
				elseif($tl->login_user == auth()->user()->id){ //TL approval staus
					$stage->status = 2; //TL approving
				}
				$stage->creator_id = User::find(auth()->user()->id)->employee->emp_id;
				$stage->tour_id = $id;
				$stage->save();
				$inserted = true;
			}
			elseif($latest_stage == 2){ //TL approved
				$stage = new TourStages();
				$stage->status = 3; //YS Sir approving
				$stage->creator_id = User::find(auth()->user()->id)->employee->emp_id;
				$stage->tour_id = $id;
				$stage->save();
				$inserted = true;
			}
			elseif($latest_stage == 3){ //YS Sir approved
				$stage = new TourStages();
				$stage->status = 4; // HR approving Amount released
				$stage->creator_id = User::find(auth()->user()->id)->employee->emp_id;
				$stage->tour_id = $id;
				$stage->save();
				$inserted = true;
			}
			elseif($latest_stage == 6){ //Tour Ended
				$stage = new TourStages();
				$stage->status = 7; // HS Sir approving
				$stage->creator_id = User::find(auth()->user()->id)->employee->emp_id;
				$stage->tour_id = $id;
				$stage->save();
				$inserted = true;
			}
			elseif($latest_stage == 7){ //HS approved alll expenses
				$stage = new TourStages();
				$stage->status = 8; // Account Final stages 
				$stage->creator_id = User::find(auth()->user()->id)->employee->emp_id;
				$stage->tour_id = $id;
				$stage->save();
				$inserted = true;
			}

			if($inserted){
				return redirect()->route('tour.show_stages',$id)->with('success','Approved Successfully!!');
			}else{
				return redirect()->route('tour.show_stages',$id)->with('error','Something went wrong!!');
			}

    }
    //declie tour
    public function decline($id){
    }
    //start tour
     public function start($id){
    	$tour = Tours::with('stages.status_info','employee','company')->where('id',$id)->first();
    	$latest_stage = $this->return_latest_stage($tour->stages);
    	$management = $this->fetch_management_users($id);
    	$d1 = $management['d1'];
    	$hr = $management['hr'];
    	$tl = $management['tl'];
    	$inserted = false;
    	//Tl, HR, Y Sir, employee can start the tour 
    	if($latest_stage == 4){  //Amount released
				$stage = new TourStages();
				$stage->status = 5; // TOur started
				$stage->creator_id = User::find(auth()->user()->id)->employee->emp_id;
				$stage->tour_id = $id;
				$stage->save();
				$inserted = true;
			}

			if($inserted){
				return redirect()->route('tour.show_stages',$id)->with('success','Tour started Successfully!!');
			}else{
				return redirect()->route('tour.show_stages',$id)->with('error','Something went wrong!!');
			}

    }
     public function end($id){
    	$tour = Tours::with('stages.status_info','employee','company')->where('id',$id)->first();
    	$latest_stage = $this->return_latest_stage($tour->stages);
    	$management = $this->fetch_management_users($id);
    	$d1 = $management['d1'];
    	$hr = $management['hr'];
    	$tl = $management['tl'];
    	$inserted = false;
    	//Tl, HR, Y Sir, employee can start the tour 
    	if($latest_stage == 5){  //Amount released
				$stage = new TourStages();
				$stage->status = 6; // TOur started
				$stage->creator_id = User::find(auth()->user()->id)->employee->emp_id;
				$stage->tour_id = $id;
				$stage->save();
				$inserted = true;
			}

			if($inserted){
				return redirect()->route('tour.show_stages',$id)->with('success','Tour ended Successfully!!');
			}else{
				return redirect()->route('tour.show_stages',$id)->with('error','Something went wrong!!');
			}

    }
    public function fetch_management_users($tour_id){
    	//To show button folllowing users details is mandatory for all checks
			$tour = Tours::with('stages.status_info','employee','company')->where('id',$tour_id)->first();
    	$d1 = EmployeeMast::where('comp_code','000')->where('emp_desg',1)->first();
    	$d2 = EmployeeMast::where('comp_code','000')->where('emp_desg',2)->first();
    	$hr = EmployeeMast::where('comp_code','000')->where('emp_desg',3)->first();
    	$tl = EmployeeMast::where('comp_code',$tour->comp_code)->whereIn('emp_desg',array(4,5))->first();
    	 return $data = array(
    	 							 'd1' => $d1,
    	 							 'd2' => $d2,
    	 							 'hr' => $hr,
    	 							 'tl' => $tl,
    	 							);
    }
}
