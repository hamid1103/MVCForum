<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class SearchController extends Controller
{
    /**
     * @param Request $request
     * @return void
     *
     * Full search with filters
     */
    public function searchSearch(Request $request)
    {
        //Get Filters(Tags, nsfw, etc)(optional)
        //Get Category(optional)
        //Get Topic(Optional)

        //Make call

        //return list(Paginated)
    }

    /**
     * @param Request $request
     * @return void
     *
     * Ignores Filters. Just tries to give a few of the found entries.
     */
    public function quickSearch(Request $request){
        //Get search string
        //Look in DB
            //Posts where content contains search string
            //Users where name contains or equals search string
            //Topics where name contains or equals search string
        //Return list of top 9
    }

}
