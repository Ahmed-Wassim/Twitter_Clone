<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{

    public function show(Idea $idea)
    {
        return view('ideas.show', compact('idea'));
    }

    public function edit(Idea $idea)
    {
        $editing = true;
        return view('ideas.show', compact('idea', 'editing'));
    }

    public function update(Request $request, Idea $idea)
    {
        if (auth()->user()->id !== $idea->user_id) {
            abort(403);
        }

        $request->validate([
            'content' => 'required|min:8'
        ]);

        $idea->update([
            'content' => $request->content
        ]);

        return redirect()->route('idea.show', $idea->id)->with('success', 'Idea updated successfully');
    }
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|min:8'
        ]);

        Idea::create([
            'user_id' => auth()->user()->id,
            'content' => $request->content
        ]);

        return redirect()->back()->with('success', 'Idea created successfully');
    }


    public function destroy(Idea $idea)
    {
        if (auth()->user()->id !== $idea->user_id) {
            abort(403);
        }

        $idea->delete();
        return redirect()->back()->with('success', 'Idea deleted successfully');
    }
}
