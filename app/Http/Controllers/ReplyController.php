<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Topic;
use Illuminate\Http\Request;

class ReplyController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Topic $topic)
    {

        request()->validate([
            'description' => ['required', 'string', 'max:1000'],

        ]);

        Reply::create([
            'description' => request()->description,
            'user_id' => auth()->user()->id,
            'topic_id' => $topic->id
        ]);

        return redirect()->route('topics.show', $topic);
    }

    /**
     * Display the specified resource.
     */
    public function show(Reply $reply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reply $reply)
    {

        return view('replies.edit', ['reply' => $reply]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Reply $reply)
    {

        request()->validate([
            'description' => ['required', 'string', 'max:1000'],
        ]);

        $reply->update([
            'description' => request()->description,
        ]);

        return redirect()->route('topics.show' , ['topic' => $reply->topic->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reply $reply)
    {
        $user = $reply->user;

        $reply->delete();

        if(url()->previous() == route('admin.users.show' , $user)){
            return redirect()->route('admin.users.show' , $user);
        }
        return redirect()->route('topics.show' , ['topic' => $reply->topic->id]);
    }
}
