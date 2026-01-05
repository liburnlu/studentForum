<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Reply;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use function Laravel\Prompts\table;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $topics = Topic::query();

        if (request()->filled('categories')) {
            $topics->whereIn('category_id', request()->input('categories'));
        }

        if (request()->query('sort') === 'views') {

            $topics->orderByDesc('views');
        }

        if (request()->query('sort') === 'replies') {
            $topics->withCount('replies')->orderByDesc('replies_count');
        }
        //withCount gives you a virtual attribute in your model : replies_count


        if (request()->filled('search')) {
            $queryStringValue = request()->query('search');

            $topics->where(
                'title', 'like', '%' . $queryStringValue . '%'
            );
        }

        $topics = $topics->with(['category', 'user', 'latestReply'])
            ->when(auth()->check(), function ($query) {
                $query->with(['bookmarks' => fn ($q) => $q->where('user_id', auth()->user()->id)]);//get the bookmarks of that authenticated user
            })
            ->withCount('replies')->latest()->paginate(10)->withQueryString();


        $categories = Category::all();

        return view('topics.index', ['topics' => $topics, 'categories' => $categories ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Topic::class);

        $categories = Category::all();
        return view('topics.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        Gate::authorize('create', Topic::class);

        //validate
        $validated = request()->validate([
            'title' => ['required', 'string', 'max:255', 'unique:topics,title'],
            'description' => ['required', 'string', 'min:10'],
            'category_id' => ['required'],
        ]);

        //create resource
        Topic::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'description' => $validated['description'],
            'user_id' => auth()->user()->id,
            'category_id' => $validated['category_id'],
        ]);

        return redirect()->route('topics.index')->with('success', 'Topic created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Topic $topic)
    {

        if (auth()->check()) {
            $alreadyViewed = $topic->views()
                ->where('user_id', auth()->id())
                ->exists();

            if (!$alreadyViewed) {
                $topic->views()->create([
                    'user_id' => auth()->id(),
                ]);

                $topic->increment('views');

            }
        }

        $topic->load(['category', 'user'])
            ->loadCount('replies');
        //when you have the model you load the relations into it (for eager loading)
        //when you don't have it you query to it

        if(auth()->check()) {
            $topic->load(['bookmarks' => fn($query) => $query->where('user_id' , auth()->user()->id)]);
        }


        $replies = $topic->replies()->with('user')->latest()->get();

        return view('topics.show', ['topic' => $topic, 'replies' => $replies]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Topic $topic)
    {

//        if(request()->user()->cannot('update', $topic)) {
//            abort(403);
//        }

        Gate::authorize('update', $topic);

        $categories = Category::all();

        return view('topics.edit', ['topic' => $topic, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Topic $topic)
    {
        Gate::authorize('update', $topic);


        $validated = request()->validate([
            'title' => ['required', 'string', 'max:255', 'unique:topics,title,' . $topic->id],
            'description' => ['required', 'string', 'min:10'],
            'category_id' => ['required'],
        ]);

        $topic->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
        ]);

        if (request()->input('redirect') === 'dashboard') {
            return redirect()->route('dashboard.topics')->with('success', 'Topic updated successfully.');
        }

        return redirect()->route('topics.show', ['topic' => $topic])->with('success', 'Topic updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Topic $topic)
    {
        Gate::authorize('delete', $topic);

        $user = $topic->user;
        $topic->delete();

        if(url()->previous() == route('admin.users.show' , $user)){
            return redirect()->route('admin.users.show' , $user)->with('success', 'Topic deleted successfully.');
        }

        if(url()->previous() == route('dashboard.topics')){

            return redirect()->route('dashboard.topics')->with('success', 'Topic deleted successfully.');
        }

        return redirect()->route('topics.index')->with('success', 'Topic deleted successfully.');
    }

}
