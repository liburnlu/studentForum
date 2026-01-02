<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $stats = [
            'users' => User::count(),
            'topics' => Topic::count(),
            'replies' => Reply::count(),
            'categories' => Category::count(),
        ];

        return view('admin.index' , ['stats' => $stats]);
    }
}
