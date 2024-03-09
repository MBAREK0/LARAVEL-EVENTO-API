<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Events =  DB::table('events as E')
                    ->select('E.*', 'U.email as author', 'C.name as category')
                    ->join('users as U', 'E.id_user', '=', 'U.id')
                    ->join('categories as C', 'E.id_categorie', '=', 'C.id')
                    ->where('E.is_published', true)
                    ->get();
        $categories=Category::all();
        return response()->json(['Events' => $Events,'categories' => $categories], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
    // return response()->json(['message' =>request()->all()], Response::HTTP_OK);

        $validator = Validator::make(request()->all(), [
                'title' => 'required|max:255',
                'description' => 'required|max:255',
                'date' => 'required',
                'prix' => 'required|max:255',
                'number_places' => 'required|max:255',
                'image_path' => 'required|max:255',
                'type_reserved' => 'required|max:255',
                'id_categorie' => 'required|max:255',
                'instagram' => 'required|max:255',
                'facebook' => 'required|max:255',
                'twitter' => 'required|max:255',
                'place' => 'required|max:255',
            ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $Events = new Event();
        $Events->title = request('title');
        $Events->description = request('description');
        $Events->date = request('date');
        $Events->place = request('place');
        $Events->prix = request('prix');
        $Events->number_places = request('number_places');
        $Events->image_path = request('image_path');
        $Events->type_reserved = request('type_reserved');
        $Events->id_categorie = request('id_categorie');
        $Events->instagram = request('instagram');
        $Events->facebook = request('facebook');
        $Events->twitter = request('twitter');
        $Events->id_user = auth()->user()->id;
        $Events->save();

        return response()->json(['message' => 'Event created successfully'], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $id = request('id');
        $Event = Event::find($id);

        if (!$Event) {
            return response()->json(['error' => 'Category not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json(['category' => $Event], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
public function update()
{
    $validator = Validator::make(request()->all(), [
        'title' => 'required|max:255',
        'description' => 'required|max:255',
        'date' => 'required',
        'prix' => 'required|max:255',
        'number_places' => 'required|max:255',
        'image_path' => 'required|max:255',
        'type_reserved' => 'required|max:255',
        'id_categorie' => 'required|max:255',
        'instagram' => 'required|max:255',
        'facebook' => 'required|max:255',
        'twitter' => 'required|max:255',
        'place' => 'required|max:255',
        'id' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $id = request('id');
    $event = Event::find($id);

    if (!$event) {
        return response()->json(['error' => 'Event not found'], Response::HTTP_NOT_FOUND);
    }

    $event->title = request('title');
    $event->description = request('description');
    $event->date = request('date');
    $event->place = request('place');
    $event->prix = request('prix');
    $event->number_places = request('number_places');
    $event->image_path = request('image_path');
    $event->type_reserved = request('type_reserved');
    $event->id_categorie = request('id_categorie');
    $event->instagram = request('instagram');
    $event->facebook = request('facebook');
    $event->twitter = request('twitter');
    $event->id_user = auth()->user()->id;
    $event->save();

    return response()->json(['message' => 'Event updated successfully'], Response::HTTP_OK);
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

      public function storeImage(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $path = $request->file('image')->store('public/images');
        $publicPath = str_replace('public/', '', $path);
        return response()->json(['path' => $publicPath]);
 }
    public function destroy()
    {
        $id = request('id');
        $category = Event::find($id);

        if (!$category) {
            return response()->json(['error' => 'Event not found'], Response::HTTP_NOT_FOUND);
        }

        $category->delete();

        return response()->json(['message' => 'Event deleted successfully'], Response::HTTP_OK);
    }
}
