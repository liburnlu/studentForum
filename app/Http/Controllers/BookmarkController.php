<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function index(){

        $bookmarks = auth()->user()->bookmarks()->with('topic')->get();

        return view('bookmarks.index' , ['bookmarks' => $bookmarks]);
    }

    public function toggle(){


        $topicId = request()->input('topic_id');
        $user = auth()->user();

        $bookmark = $user->bookmarks()->where('topic_id' , $topicId)->first();

        if($bookmark){
            $bookmark->delete();
        }

        else{
            Bookmark::create([
                'topic_id' => $topicId,
                'user_id' => $user->id,
            ]);
        }

        return back();

    }
}
