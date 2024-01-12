<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $ideas = Idea::with('user', 'comments.user')->latest()->paginate(8);

        if (request()->has('search')) {
            $ideas = Idea::where('content', 'like', '%' . request('search') . '%')->latest()->paginate(8);
        }

        return view('dashboard', compact('ideas'));
    }
}
