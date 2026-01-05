<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReplyController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Topic $topic)
    {

        Gate::authorize('create', Reply::class);

        $validated = request()->validate([
            'description' => ['required', 'string', 'max:1000'],

        ]);

        Reply::create([
            'description' => $validated['description'],
            'user_id' => auth()->user()->id,
            'topic_id' => $topic->id
        ]);

        return redirect()->route('topics.show', $topic)->with('success', 'Reply added successfully.');
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
        Gate::authorize('update', $reply);

        return view('replies.edit', ['reply' => $reply]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Reply $reply)
    {
        Gate::authorize('update', $reply);

        $validated = request()->validate([
            'description' => ['required', 'string', 'max:1000'],
        ]);

        $reply->update([
            'description' => $validated['description'],
        ]);

        if (request()->input('redirect') === 'dashboard') {
            return redirect()->route('dashboard.replies')->with('success', 'Reply updated successfully.');
        }

        return redirect()->route('topics.show' , ['topic' => $reply->topic->id])->with('success', 'Reply updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reply $reply)
    {

        Gate::authorize('delete', $reply);

        $user = $reply->user;

        $reply->delete();

        if(url()->previous() == route('admin.users.show' , $user)){
            return redirect()->route('admin.users.show' , $user)->with('success', 'Reply deleted successfully.');
        }


        if(url()->previous() == route('dashboard.replies' )){
            return redirect()->route('dashboard.replies' )->with('success', 'Reply deleted successfully.');
        }
        return redirect()->route('topics.show' , ['topic' => $reply->topic->id])->with('success', 'Reply deleted successfully.');
    }
}
