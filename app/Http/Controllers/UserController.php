<?php

namespace App\Http\Controllers;

use App\Actions\FileUpload;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $totalTasks = $user->tasks()->count();
        $completedTasks = $user->tasks()->where('is_completed', true)->count();
        $pendingTasks = $totalTasks - $completedTasks;
        $progressPercentage = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;

        return view('user.profile', compact('totalTasks', 'completedTasks', 'pendingTasks', 'progressPercentage'));
    }

    public function update()
    {
        $user = Auth::user();
        return view('user.edit', ['user'=> $user]);
    }

    public function edit(ProfileRequest $request, FileUpload $fileUpload)
    {
        $user = Auth::user();

        $request->validated();

        $data = $request->only(['name', 'email', 'username']);

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $data['avatar'] = $fileUpload->handle('avatar', 'avatars', 'public');
        }

        $user->update($data);

        return redirect()->route('profile');
    }
}
