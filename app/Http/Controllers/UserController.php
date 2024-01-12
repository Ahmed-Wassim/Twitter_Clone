<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function profile()
    {
        return $this->show(Auth::user());
    }
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $ideas = $user->ideas()->paginate(5);
        return view('users.show', compact('user', 'ideas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if (auth()->id() !== $user->id) {
            abort(404);
        }

        $ideas = $user->ideas()->paginate(5);
        return view('users.edit', compact('user', 'ideas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if (auth()->id() !== $user->id) {
            abort(404);
        }

        $validated = $request->validate([
            'name' => 'required|min:4|max:20',
            'bio' => 'nullable|max:255',
        ]);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'nullable|image'
            ]);

            $imagePath = $request->file('image')->store('profiles', 'public');
            $validated['image'] = $imagePath;

            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
        }

        $user->update($validated);

        return redirect()->route('users.profile')->with('success', 'User updated successfully');
    }
}
