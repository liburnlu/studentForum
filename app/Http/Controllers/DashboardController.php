<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $stats = ['topics'];
        //$stats['topics'] = Topic::where('user_id' , auth()->user()->id)->count();
        $stats['topics'] = auth()->user()->topics()->count();

        $stats['replies'] = auth()->user()->replies()->count();

        $stats['bookmarks'] = auth()->user()->bookmarks()->count();

        $stats['views'] = auth()->user()->topics()->sum('views');


        $latestTopics = auth()->user()->topics()->latest()->limit(5)->get();

        $latestReplies = auth()->user()->replies()->latest()->limit(5)->get();

        return view('dashboard.index' , ['stats' => $stats , 'latestTopics' => $latestTopics , 'latestReplies' => $latestReplies]);

    }

    public function topics(){


        $topics = auth()->user()->topics()->latest()->paginate(10);

        return view('dashboard.topics' , ['topics' => $topics]);
    }

    public function replies(){

        $replies = auth()->user()->replies()->latest()->paginate(10);

        return view('dashboard.replies' , ['replies' => $replies]);
    }
}
