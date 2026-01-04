<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;

class BookmarkController extends Controller
{
    public function index(){

        $bookmarks = auth()->user()->bookmarks()->with([
            'topic' => fn($query) => $query->withCount('replies')->with(['user' , 'category'])
        ])->latest()->paginate(10);

        return view('bookmarks.index' , ['bookmarks' => $bookmarks]);
    }

    public function toggle(){


        $topicId = request()->input('topic_id');
        $user = auth()->user();

        $bookmark = $user->bookmarks()->where('topic_id' , $topicId)->first();

        if($bookmark){
            $bookmark->delete();
            return redirect()->back()->with('success' , 'Topic removed from bookmarks.');
        }

        else{
            Bookmark::create([
                'topic_id' => $topicId,
                'user_id' => $user->id,
            ]);
        }

        return redirect()->back()->with('success' , 'Topic bookmarked successfully.');

    }
}
