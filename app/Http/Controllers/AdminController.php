<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Event;
use Validator;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getUsers()
    {
        $users  = User::where('role_id', '<>', 3)->get();
        $roles  = Role::all();
        return response()->json(['users' => $users,'roles' => $roles],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function updateRole()
    {
         $validator = Validator::make(request()->all(), [
        'role_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $id = request('id');
        $User = User::find($id);

        if (!$User) {
            return response()->json(['error' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        $User->role_id = request('role_id');
        $User->update();

        return response()->json(['message' => 'User role updated successfully'], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function destroyUser()
    {
        $id = request('id');
        $User = User::find($id);

        if (!$User) {
            return response()->json(['error' => 'User not found'], Response::HTTP_NOT_FOUND);
        }
        $User->delete();
        return response()->json(['message' => 'User deleted successfully'], Response::HTTP_OK); 
    }

    /**
     * Display the specified resource.
     */
    public function acceptEvent()
    {

        $id = request('id');
        $Event = Event::find($id);

        if (!$Event) {
            return response()->json(['error' => 'Event not found'], Response::HTTP_NOT_FOUND);
        }

        $Event->is_published = 1;
        $Event->update();

        return response()->json(['message' => 'Event Visibility updated successfully'], Response::HTTP_OK);
    }



    /**
     * Update the specified resource in storage.
     */
    public function getEvents()
    {
        $Events = DB::table('events as E')
                    ->select('E.*', 'U.email as author', 'C.name as category')
                    ->join('users as U', 'E.id_user', '=', 'U.id')
                    ->join('categories as C', 'E.id_categorie', '=', 'C.id')
                    ->where('E.is_published', false)
                    ->get();
        return response()->json(['Events' => $Events], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
   public function statistics()
{
    $users = User::where('role_id', '<>', 3)
                  ->where('role_id', '<>', 2)
                  ->count();

    $organizers = User::where('role_id', '<>', 3)
                       ->where('role_id', '<>', 1)
                       ->count();

    $eventsAccepted = Event::where('is_published', true)->count();
    $eventsNotAccepted = Event::where('is_published', false)->count();

    return response()->json([
        'users' => $users,
        'organizers' => $organizers,
        'eventsAccepted' => $eventsAccepted,
        'eventsNotAccepted' => $eventsNotAccepted,
    ], Response::HTTP_OK);
}

}
