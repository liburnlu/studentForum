<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $user = auth()->user();


        $stats = [];
        $stats['topics'] = $user->topics()->count();

        $stats['replies'] = $user->replies()->count();

        $stats['bookmarks'] = $user->bookmarks()->count();

        $stats['views'] = $user->topics()->sum('views');


        $latestTopics = $user->topics()
            ->withCount('replies')
            ->latest()
            ->limit(5)
            ->get();



        $latestReplies = $user->replies()
            ->with('topic')
            ->latest()
            ->limit(5)
            ->get();

        return view('dashboard.index' , ['stats' => $stats , 'latestTopics' => $latestTopics , 'latestReplies' => $latestReplies]);

    }

    public function topics(){


        $topics = auth()->user()->topics()->withCount('replies')->latest()->paginate(15);

        return view('dashboard.topics' , ['topics' => $topics]);
    }

    public function replies(){

        $replies = auth()->user()->replies()->with('topic')->latest()->paginate(15);

        return view('dashboard.replies' , ['replies' => $replies]);
    }

    //Dashboard latest topics: withCount('replies') avoids N+1 queries when showing reply counts.
    //
    //Dashboard latest replies: with('topic') avoids N+1 queries when displaying the topic title.
}
