<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminDashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(Request $request)
    {

//        if(!Gate::allows('view-admin-panel')){
//            abort(403);
//        }
          //Gate::authorize('view-admin-panel');

        //Gate::allowIf(fn(User $user) => $user->role==='admin'); inline authorization without a dedicated gate


        $stats = [
            'users' => User::count(),
            'topics' => Topic::count(),
            'replies' => Reply::count(),
            'categories' => Category::count(),
        ];

        return view('admin.index' , ['stats' => $stats]);
    }

}
