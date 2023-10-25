<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
        ])->with('success', "The status of " . $user->name . " has been updated.");
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
        ])->with('success', "The status of " . $user->name . " has been updated.");
    }

    public function notready(User $user)
    {
        $user->status = 'NOTREADY';
        $user->save();
        dd($user);

        $users = User::where('journey_id', Auth::user()->journey_id)
            ->where('role', 'CREW')
            ->get();
        $usersForAdmin = User::get();
        return redirect()->route('crews.index' , [
            'users' => $users,
            'usersForAdmin' => $usersForAdmin
        ])->with('success', "The status of " . $user->name . " has been updated.");
    }

}
