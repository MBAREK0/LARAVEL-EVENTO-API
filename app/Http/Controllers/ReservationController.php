<?php

namespace App\Http\Controllers;

use App\Models\reservation;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    /**'manuel','automatic'
     * 'pending','approved','rejected'
     * Display a listing of the resource.
     */
    public function add_reservation ()
    {
       $user_id = auth()->user()->id;
       $email = auth()->user()->email;
       $event_id = request('id');
       $event = Event::find($event_id) ; 
       $type_reserved =  $event->type_reserved;
    
       $reservatio  = new reservation();
       $reservatio->id_event =  $event_id;
       $reservatio->id_user =  $user_id;

        if($event->number_places > 0){
            if($type_reserved === 'automatic'){
                    $reservatio->status = 'approved' ;
                    $data['email'] = $email; 
                    $data['subject'] = 'get your ticket'; 
                    $data['view'] = 'mail.ticket';
                    $data['content']['title'] =  $event->title;
                    $data['content']['image_path'] =  $event->image_path;
                    $data['content']['description'] =$event->description;
                    $data['content']['firstname'] = auth()->user()->firstName ;
                    $data['content']['lastname'] = auth()->user()->lastName;;
                    dispatch(new SendEmailJob($data));
                    $reserved =  $reservatio->save();
                    if($reserved){
                        $event->number_places  = $event->number_places - 1; 
                        $event->save(); }
            }else{
                    $reservatio->status = 'pending' ;
                    $reservatio->save();
            }
        }

        return response()->json('reservation added seccesfuly',200);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function get_reservation()
    {
      $reservations = DB::table('reservations as R')
                        ->select('R.id', 'E.title', 'U.email')
                        ->join('events as E', 'R.id_event', '=', 'E.id')
                        ->join('users as U', 'R.id_user', '=', 'U.id')
                        ->where('R.status', '=', 'pending')
                        ->where('E.id_user',auth()->user()->id)
                        ->get();

        return response()->json(['reservations' => $reservations], Response::HTTP_OK);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function accept_reservation()
    {
        $id = request('id');
        $status = request('status');

        $reservation = reservation::find($id);

      
       $user  = User::find($reservation->id_user);
       $event = Event::find($reservation->id_event);

       $email =  $user->email;
 

        if (!$reservation) {
            return response()->json(['error' => 'reservation is not found'], Response::HTTP_NOT_FOUND);
        }

        if($status === 'approved'){
            $reservation->status = 'approved' ;
                    $data['email'] = $email; 
                    $data['subject'] = 'get your ticket'; 
                    $data['view'] = 'mail.ticket';
                    $data['content']['title'] =  $event->title;
                    $data['content']['description'] =$event->description;
                    $data['content']['firstname'] = $user->firstName ;
                    $data['content']['lastname'] = $user->lastName;;
                    dispatch(new SendEmailJob($data));
                    $reserved =  $reservation->save();
                    if($reserved){
                        $event->number_places  = $event->number_places - 1; 
                        $event->save(); }
        }else if($status === 'rejected'){
            $reservation->status = $status ;
            $reservation->save();
        }
       
    }


 
}
