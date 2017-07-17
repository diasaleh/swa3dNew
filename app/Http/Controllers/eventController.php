<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Volunteer;
use App\Event;
use App\EventIntrest;
use App\EventTarget;
use App\Friend;
use App\Invite;


class eventController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $date = date('Y-m-d');
            $user = Auth::user();
            $this->date = $date;
            $this->user = $user;
            return $next($request);
        });
    }

    public function invite(Request $request)
    {
        if($request->has('invited'))
        {
            $i = 0;
            $userId = $request['userId'];
            if(!is_array($request->invited))
            {
                $request->invited = array($request->invited);
            }
            $forFlag = false;
            for($i ;$i < sizeof($request->invited) ;$i++)
            {   
                $eventId = $request->invited[$i];
                $user = Auth::user();
                $mine = event::where('id',$eventId)->where('user_id',$user->id)->first();
                if($mine)
                {
                    $user = user::where('id',$userId)->first();
                    if($user)
                    {
                        if($user->userType == 0 || $user->userType == 3){
                            $forFlag = true;
                            $flag = 0;
                            $preInv = invite::where('event_id',$eventId)->where('user_id',$user->id)->first();
                            $preVol = volunteer::where('event_id',$eventId)->where('user_id',$user->id)->first();
                            if($preVol || $preInv)
                            {
                                continue;
                            }
                            $invite = new invite();
                            $invite->event_id = $eventId;
                            $invite->user_id = $user->id;
                            $invite->save();
                            continue;
                        }else
                            return redirect()->route('errorPage')->withErrors("You can't send an invitation.");
                    }else
                        return redirect()->route('errorPage')->withErrors("profile not found.");
                }else
                    return redirect()->route('errorPage')->withErrors("this event not yours.");
            }
            if($forFlag)
            {
                return redirect()->route('upComingEvents');
            }
        }
        return redirect()->back();
    }

    public function makeEvent(){
        $user = Auth::user();
        if($user->userType == 1 || $user->userType == 3)
        {
            $date = $this->date;
            $Aevents = event::where('user_id', $user->id)->where('startDate','<',$date);
            $Uevents = event::where('user_id', $user->id)->where('startDate','>',$date);
            return view('events/makeEvent',compact('user','Aevents','Uevents'));
        }
        return abort(403, 'Unauthorized action.');
    }

    public function makeEventPost(Request $request){
        $user = Auth::user();
        $this->validate($request, [
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'country' => 'required|string',
            'startDate' => 'required|date|after:today',
            'endDate' => 'required|date|after:startDate',
        ]);
        $event = new event();
        $event->title = $request['title'];
        $event->user_id = $user->id;
        $event->description = $request['description'];
        $event->country = $request['country'];
        $event->cityName = $request['cityName'];
        $event->startDate = $request['startDate'];
        $event->endDate = $request['endDate'];
        $event->open = $request['open'];
        if ($request->hasFile('cover')){
            $mainImg=$request->file('cover');
            $imagename=time().'.'.$mainImg->getClientOriginalExtension();
            Image::make($mainImg)->resize(350,200)->save(public_path('events/'.$imagename));
            $event->cover = $imagename;
        }
        $event->save();
        $eveint= new  eventIntrest();
        $eveint->event_id=$event->id;
        $eveint->intrest_id=$request['intrests'];
        $eveint->save();

        $evetarget= new EventTarget();
        $evetarget->event_id=$event->id;
        $evetarget->target_id=$request['target'];
        $evetarget->save();

        return redirect()->route('event',compact('event'));
    }

    public function myEvents(){
        $user = Auth::user();
        $date = $this->date;
        $Aevents = event::where('user_id', $user->id)->where('startDate','<',$date);
        $Uevents = event::where('user_id', $user->id)->where('startDate','>',$date)->get();
        return view('events/myEvents',compact('user','Aevents','Uevents'));
    }

    public function archiveMyEvents() {
        $user = Auth::user();
        $date = $this->date;
        $Aevents = event::where('user_id', $user->id)->where('startDate','<',$date)->get();
        $Uevents = event::where('user_id', $user->id)->where('startDate','>',$date);
        return view('events/archiveMyEvents',compact('user','Aevents','Uevents'));
    }

    

    public function eventDelete($eventId){
        $user = Auth::user();
        $date = date('Y-m-d');
        $event = event::find($eventId);
        if($event){
            if($event->user_id == $user->id){
                if($event->startDate > $date){
                    $event->delete();
                }
            }
        }
        return redirect()->route('myEvents');
    }

    public function eventEdit($eventId){
        $user = Auth::user();
        $date = $this->date;
        $event = event::find($eventId);
        if($event){
            if($event->user_id == $user->id){
                if($event->startDate > $date){
                    $Aevents = event::where('user_id', $user->id)->where('startDate','<',$date);
                    $Uevents = event::where('user_id', $user->id)->where('startDate','>',$date);
                    return view('events/eventEdit',compact('event','user','Uevents','Aevents'));
                }
            }
        }
        return redirect()->route('home');
    }

    public function eventEditPost(Request $request){
        $user = Auth::user();
        $date = $this->date;

        $this->validate($request, [
            'eventId' => 'required',
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'startDate' => 'required|date|after:today',
            'endDate' => 'required|date|after:startDate',
        ]);

        $eventId = $request['eventId'];
        $event = event::find($eventId);
        if($event){
            if($event->user_id == $user->id){
                if($event->startDate > $date){
                    $event->title = $request['title'];
                    $event->country = $request['country'];
                    $event->city = $request['cityName'];
                    $event->user_id = $user->id;
                    $event->description = $request['description'];
                    $event->startDate = $request['startDate'];
                    $event->endDate = $request['endDate'];
                    $event->save();
                    return redirect()->route('event',compact('event'));
                }
            }
        }
        return redirect()->back();
    }


    /**
     * volunteer button on the event clicked by individual
     * but not virefied from the institue that made this event.
     *
     * @return \Illuminate\Http\Response
     */

    public function volunteer($eventId)
    {
        $user = Auth::user();
        if($user->userType == 0 || $user->userType == 3){
            $preVol = volunteer::where('event_id',$eventId)->where('user_id',$user->id)->first();
            if($preVol){
                return redirect()->route('errorPage')->withErrors('You already sent a volunteer request.');
            }
            $volunteer = new volunteer();
            $volunteer->event_id = $eventId;
            $volunteer->user_id = $user->id;
            $volunteer->save();
            return redirect()->route('event',compact('eventId'));
        }else
            return redirect()->route('errorPage')->withErrors("You can't volunteer.");
    }

    /**
     * disVolunteer button on the event clicked by individual
     * to cancel his volunteer request.
     *
     * @return \Illuminate\Http\Response
     */
    public function disVolunteer($eventId)
    {
        if(Auth::check()){
            $user = Auth::user();
            if($user->userType == 0 || $user->userType == 3){
                $eventVols = volunteer::where('event_id',$eventId)->where('user_id',$user->id)->delete();
                return redirect()->route('upComingEvents');
            }else{
                return redirect()->route('home');
            }
        }
    }
    /**
     * accept Volunteer -- verify from the institue that made this event.
     *
     * @return \Illuminate\Http\Response
     */
    public function acceptVolunteer(Request $request,$eventId)
    {
        if($request->has('accepted'))
        {
            $i = 0;
            $user = Auth::user();
            if(!is_array($request->accepted))
            {
                $request->accepted = array($request->accepted);
            }
            $event = Event::find($eventId);
            if($user->userType == 1 || $user->userType == 3)
            {
                if($event->user_id == $user->id)
                {
                    for($i ;$i < sizeof($request->accepted) ;$i++)
                    {   
                        $volunteerId = $request->accepted[$i];
                        $volunteeruser = user::where('id',$volunteerId)->first();
                        $volunteer = volunteer::where('user_id',$volunteerId)->where('event_id',$eventId)->first();
                        $invite = invite::where('event_id',$eventId)->where('user_id',$volunteerId)->first();
                        if($volunteeruser)
                        {   
                            if($volunteer)
                            {
                                $volunteer->accepted = 1;
                                if($invite)$invite->delete();
                                $volunteer->save();
                                continue;
                            }else
                                return redirect()->route('errorPage')->withErrors("request not found.");
                        }else
                            return redirect()->route('errorPage')->withErrors("profile not found.");
                    }
                }else
                    return redirect()->route('errorPage')->withErrors("this event not yours.");
            }else
                return redirect()->route('errorPage')->withErrors("You can't.");
        }
        return redirect()->back();
    }

    /**
     * unAccept Volunteer which accepted before.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function unAcceptVolunteer(Request $request,$eventId)
    {
        if($request->has('unaccepted'))
        {
            $i = 0;
            $user = Auth::user();
            if(!is_array($request->unaccepted))
            {
                $request->unaccepted = array($request->unaccepted);
            }
            $event = Event::find($eventId);
            if($user->userType == 1 || $user->userType == 3)
            {
                if($event->user_id == $user->id && $volunteer)
                {
                    for($i ;$i < sizeof($request->unaccepted) ;$i++)
                    {   
                        $volunteerId = $request->unaccepted[$i];
                        $volunteeruser = user::where('id',$volunteerId)->first();
                        $volunteer = volunteer::where('user_id',$volunteerId)->where('event_id',$eventId)->first();
                        if($volunteeruser)
                        {
                            $volunteer = volunteer::where('user_id',$volunteerId)->where('event_id',$eventId)->first();
                            $volunteer->accepted = 0;
                            $volunteer->save();
                        }else
                            return redirect()->route('errorPage')->withErrors("profile not found.");
                    }
                }else
                    return redirect()->route('errorPage')->withErrors("this event not yours.");
            }else
                return redirect()->route('errorPage')->withErrors("You can't.");
        }
        return redirect()->back();
    }

    public function closeEvent($eventId)
    {
        $event = Event::findOrFail($eventId);
        $user = $this->user;
        if($event->user_id == $user->id)
        {
            $event->open = 0;
            $event->save();
            return redirect()->back();
        }
        return redirect()->route('errorPage')->withErrors('not yours.');
    }

    public function openEvent($eventId)
    {
        $event = Event::findOrFail($eventId);
        $user = $this->user;
        if($event->user_id == $user->id)
        {
            $event->open = 1;
            $event->save();
            return redirect()->back();
        }
        return redirect()->route('errorPage')->withErrors('not yours.');
    }
}
