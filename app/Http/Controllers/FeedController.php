<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $followingsIds = auth()->user()->followings()->pluck('user_id');

        $ideas = Idea::whereIn('user_id', $followingsIds)->latest()->paginate(8);

        if (request()->has('search')) {
            $ideas = Idea::where('content', 'like', '%' . request('search') . '%')->latest()->paginate(8);
        }

        return view('dashboard', compact('ideas'));
    }
}
