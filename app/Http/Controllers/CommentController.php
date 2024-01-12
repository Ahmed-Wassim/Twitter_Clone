<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Idea $idea)
    {

        $this->validate(request(), [
            'content' => 'required'
        ]);

        Comment::create([
            'user_id' => auth()->user()->id,
            'idea_id' => $idea->id,
            'content' => request()->get('content')
        ]);

        return redirect()->route('idea.show', $idea->id)->with('success', 'Comment created successfully');
    }
}
