<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\auth;
use Illuminate\Support\Facades\DB;
use App\news;
use App\Individuals;
use App\slider;
use App\event;
use App\volunteer;
class mainController extends Controller
{

	public function __construct()
    {
            $this->date = date('Y-m-d');
    }

	public function main() {
		// if(Auth::attempt() || Auth::user()){
		// 	if(Auth::user()->flag == 0){
		// 		return redirect()->route('step');
		// 	}elseif(Auth::user()->flag == 1){
		// 		return view('main');
		// 	}
		// }else{

		$_3slides=slider::orderBy('created_at','desc')->take(3)->get();
		$volunteers=Individuals::orderBy('created_at','desc')->take(5)->get();
		$news_record=news::orderBy('created_at','desc')->take(3)->get();
         return view('main',compact('volunteers','_3slides','news_record'));

		// }
	}

	public function upComingEvents() {
        $user = Auth::user();
        $date = $this->date;
        $events = event::where('startDate','>',$date)->paginate(5,['*'],'events');

        if (Auth::check()) {
            if($user->userType==0){
            $Iuser=$user->Individuals;

            } 
            elseif ($user->userType==1) {
            $Iuser=$user->Institute;

                # code...
              } 
            elseif ($user->userType==2) {
            $Iuser=$user->Researcher;

                # code...
              } 
            $localevents = event::where('startDate','>',$date)->where('country','=',$Iuser->country)->paginate(5,['*'],'areaEvents');
            $volEvents = volunteer::where('individual_id', $Iuser->id)->get();
            return view('upComingEvents',compact('events','localevents','volEvents','user'));
        }   
        return view('upComingEvents',compact('events'));

    }
    public function allLocal() {
        $user = Auth::user();
        $date = $this->date;

        if (Auth::check()) {
            if($user->userType==0){
            $Iuser=$user->Individuals;

            } 
            elseif ($user->userType==1) {
            $Iuser=$user->Institute;

                # code...
              } 
            elseif ($user->userType==2) {
            $Iuser=$user->Researcher;

                # code...
              } 
            $localevents = event::where('startDate','>',$date)->where('country','=',$Iuser->country)->paginate(10,['*'],'areaEvents');
            $volEvents = volunteer::where('individual_id', $Iuser->id)->get();
            return view('allLocal',compact('localevents','volEvents','user'));
        }   

    }
    public function allEvents() {
        $user = Auth::user();
        if($user->userType==0){
            $Iuser=$user->Individuals;
        } 
        $date = $this->date;
        $volEvents = volunteer::where('individual_id', $Iuser->id)->get();
        $events = event::where('startDate','>',$date)->paginate(10,['*'],'events');
        return view('allEvents',compact('events','volEvents','user'));
    }

	public function archiveEvents() {
    	$user = Auth::user();
    	$date = $this->date;
    	$events = event::where('startDate','<',$date)->get();
		return view('archiveEvents',compact('events'));
	}

	public function event($eventId){
    	$event = event::find($eventId);
        if($event){
        	if(Auth::check()){
        		$user = Auth::user();
                $mine = false;
                $request = false;
                $eventAcceptedVols = volunteer::where('event_id',$eventId)->where('accepted',1)->get();
        		if($user->userType == 1 && $event->user_id == $user->id){
        			$mine = true;
                    $eventVols = volunteer::where('event_id',$eventId)->get();
                    $Individuals = Individuals::all();
                    return view('event',compact('event','request','mine','user','eventVols','eventAcceptedVols','Individuals'));
        		}elseif ($user->userType == 0) {
                    $individual = $user->Individuals;
                    $volunteer = volunteer::where('event_id',$eventId)->where('individual_id',$individual->id)->first();
                    if($volunteer){
                        $request = true;
                    }
                }
                return view('event',compact('event','eventAcceptedVols','mine','request','user'));
        	}
            return view('event',compact('event','eventAcceptedVols'));
        }else{
            return redirect()->route('upComingEvents');
        }

	}
}
