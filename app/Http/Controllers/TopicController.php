<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Reply;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $topics = Topic::all();

        return view('topics.index' , ['topics' => $topics]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('topics.create' , ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        //validate
        request()->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category_id' => ['required'],
        ]);

        //create resource
        Topic::create([
            'title' => request()->title,
            'slug' => Str::slug(request()->title),
            'description' => request()->description,
            'user_id' => rand(1,20),
            'category_id' => request()->category_id,
        ]);

        return redirect()->route('topics.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Topic $topic)
    {
        $reply  = $topic->replies()->get();
        return view('topics.show' , ['topic' => $topic , 'reply' => $reply]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Topic $topic)
    {
        $categories = Category::all();

        return view('topics.edit' , ['topic' => $topic , 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Topic $topic)
    {
        request()->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category_id' => ['required'],
        ]);

        $topic->update([
            'title' => request()->title,
            'slug' => Str::slug(request()->title),
            'description' => request()->description,
            'user_id' => old('user_id' , $topic->user_id),
            'category_id' => request()->category_id,
        ]);

        return redirect()->route('topics.show', ['topic' => $topic ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Topic $topic)
    {
    $topic->delete();
    return redirect()->route('topics.index');
    }
}
