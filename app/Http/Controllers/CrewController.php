<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CrewController extends Controller
{

    public function index()
    {
        $users = User::where('journey_id', Auth::user()->journey_id)
            ->where('role', 'CREW')
            ->get();
        $usersForAdmin = User::get();
        return view('crews.index' , [
            'users' => $users,
            'usersForAdmin' => $usersForAdmin
        ]);
    }

    public function pending(User $user)
    {
        $user->status = 'PENDING';
        $user->save();

        $users = User::where('journey_id', Auth::user()->journey_id)
            ->where('role', 'CREW')
            ->get();
        $usersForAdmin = User::get();
        return redirect()->route('crews.index' , [
            'users' => $users,
            'usersForAdmin' => $usersForAdmin
        ])->with('success', 'The status has been updated.');
    }



    public function ready(User $user)
    {
        $user->status = 'READY';
        $user->save();

        $users = User::where('journey_id', Auth::user()->journey_id)
            ->where('role', 'CREW')
            ->get();
        $usersForAdmin = User::get();
        return redirect()->route('crews.index' , [
            'users' => $users,
            'usersForAdmin' => $usersForAdmin
        ])->with('success', 'The status has been updated.');
    }

    public function notready(User $user)
    {
        $user->status = 'NOTREADY';
        $user->save();

        $users = User::where('journey_id', Auth::user()->journey_id)
            ->where('role', 'CREW')
            ->get();
        $usersForAdmin = User::get();
        return redirect()->route('crews.index' , [
            'users' => $users,
            'usersForAdmin' => $usersForAdmin
        ])->with('success', 'The status has been updated.');
    }



    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('crews.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('crews.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
