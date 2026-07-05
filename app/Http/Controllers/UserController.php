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
    /**
     * Display the authenticated user's profile and progress metrics.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Count total, completed, and pending tasks for this user.
        $totalTasks = $user->tasks()->count();
        $completedTasks = $user->tasks()->where('is_completed', true)->count();
        $pendingTasks = $totalTasks - $completedTasks;
        
        // Compute overall progress percentage, handling divide-by-zero safely.
        $progressPercentage = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;

        return view('user.profile', compact('totalTasks', 'completedTasks', 'pendingTasks', 'progressPercentage'));
    }

    /**
     * Show the edit profile form.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('user.edit', ['user'=> $user]);
    }

    /**
     * Update the user profile details in the database and handle avatar upload.
     */
    public function update(ProfileRequest $request, FileUpload $fileUpload)
    {
        $user = Auth::user();

        // Retrieve validated request data from ProfileRequest.
        $request->validated();

        $data = $request->only(['name', 'email', 'username']);

        // Check if the user uploaded a new avatar file.
        if ($request->hasFile('avatar')) {
            // Delete the old avatar from the public disk if it exists.
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Delegate storing the file to our single-purpose Actions/FileUpload class.
            $data['avatar'] = $fileUpload->handle('avatar', 'avatars', 'public');
        }

        // Save modifications to the User model.
        $user->update($data);

        return redirect()->route('profile');
    }
}
