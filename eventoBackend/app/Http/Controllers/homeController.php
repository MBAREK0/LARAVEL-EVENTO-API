<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Http\Response;

class HomeController extends Controller
{
public function events()
{
    $searchQuery = request('search');
    $categoryId = request('category');
    $pageNumber = request('pageNumber');
     $start =0 ;

        $eventsNumInThePage = 3;
        $eventsCount = DB::table('events')
                        ->where('is_published', true)
                        ->count();
        $pages = ceil( $eventsCount/$eventsNumInThePage);



        $page =$pageNumber -1;
        $start = $page *  $eventsNumInThePage ;











        $eventsQuery = DB::table('events as E')
            ->select('E.*', 'U.email as author', 'C.name as category')
            ->join('users as U', 'E.id_user', '=', 'U.id')
            ->join('categories as C', 'E.id_categorie', '=', 'C.id')
            ->where('E.is_published', true)
            ->skip($start) // Skip the first 3 rows (0-based index)
            ->take($eventsNumInThePage);

        if ($searchQuery) {
            $eventsQuery->where('E.title', 'like', '%' . $searchQuery . '%');
        }

        if ($categoryId) {
            $eventsQuery->where('E.id_categorie', $categoryId);
        }

        $events = $eventsQuery->get();

    $categories = Category::all();

    return response()->json(['Events' => $events, 'categories' => $categories ,'pages' => $pages], Response::HTTP_OK);
}

}
