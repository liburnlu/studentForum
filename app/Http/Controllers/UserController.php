<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::query();

        if(request()->filled('search')){
            $search = request()->query('search');

            $users->where('name', 'like', '%' . $search . '%');
        }

        $users = $users->latest()->paginate(10)->withQueryString();

        return view('admin.users.index', ['users' => $users]);
    }


    public function show(User $user){

        $user->loadCount(['topics' , 'replies' , 'bookmarks']);

        $topics = $user->topics()->with('category')->withCount('replies')->latest()->paginate(5 , ['*'] ,'topics');

        $replies = $user->replies()->with('topic')->latest()->paginate(5 , ['*'] ,'replies');

        $bookmarks = $user->bookmarks()->with('topic')->latest()->paginate(5 , ['*'] ,'bookmarks');

        return view('admin.users.show', ['user' => $user , 'topics' => $topics , 'replies' => $replies, 'bookmarks' => $bookmarks]);

    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {

        return view('admin.users.edit' , ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

        $validated = $request->validate([
            'name' => ['required' , 'string' , 'max:255'],
            'email' => ['required' , 'email' , 'unique:users,email,'. $user->id],
            'role' => ['required']
        ]);

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully')->with('success', 'User updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
}
