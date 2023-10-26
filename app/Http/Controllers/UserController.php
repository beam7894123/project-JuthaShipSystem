<?php

namespace App\Http\Controllers;

use App\Models\Journey;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

    public function view(User $user)
    {
        return view('crews.view', [
            'user' => $user,
        ]);
    }

    public function edit(User $user)
    {
        return view('crews.edit', [
            'user' => $user,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:1'],
            'email' => ['required', 'min:1'],
            'password' => ['required', 'min:5','required_with:confirm_password','same:confirm_password'],
            'confirm_password' => ['required', 'min:5'],
            'role' => ['required'],
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules as needed
        ]);

        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));

        if($request->file('image') != null )
        {
            $imagePath = $request->file('image')->store('userImages', 'public'); // Store image in 'public/images' folder
            $user->imgPath = $imagePath;
        }

        $user->role = $request->get('role');
        $user->status = 'PENDING';

        $user->save();

        $users = User::where('journey_id', Auth::user()->journey_id)
            ->where('role', 'CREW')
            ->get();
        $usersForAdmin = User::get();
        return redirect()->route('crews.index' , [
            'users' => $users,
            'usersForAdmin' => $usersForAdmin
        ])->with('success', "The user : " . $user->name . " has been created.");
    }

    public function create()
    {
        return view('crews.create');
    }

    public function update(Request $request , User $user)
    {
        $request->validate([
            'name' => ['required', 'min:1'],
            'email' => ['required', 'min:1'],
            'password' => ['min:5','required_with:confirm_password','same:confirm_password'],
            'confirm_password' => ['min:5'],
            'role' => ['required'],
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules as needed
        ]);

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        if($request->get('password') != null)
        {
            $user->password = Hash::make($request->get('password'));
        }

        if($request->file('image') != null )
        {
            $imagePath = $request->file('image')->store('userImages', 'public'); // Store image in 'public/images' folder

            if ($user->imgPath != null) {
                if (Storage::disk('public')->exists($user->imgPath))
                {
                    Storage::disk('public')->delete($user->imgPath);
                }
            }
            $user->imgPath = $imagePath;
        }

        $user->role = $request->get('role');
        $user->status = 'PENDING';

        $user->save();

        $users = User::where('journey_id', Auth::user()->journey_id)
            ->where('role', 'CREW')
            ->get();
        $usersForAdmin = User::get();
        return redirect()->route('crews.view' , [
            'user' => $user,
        ])->with('success', "The user : " . $user->name . " has been updated.");
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
//        dd($user);

        $users = User::where('journey_id', Auth::user()->journey_id)
            ->where('role', 'CREW')
            ->get();
        $usersForAdmin = User::get();
        return redirect()->route('crews.index' , [
            'users' => $users,
            'usersForAdmin' => $usersForAdmin
        ])->with('success', "The status of " . $user->name . " has been updated.");
    }


    public function assignment(Journey $journey)
    {
        $users = User::get();
        return view('crews.assignment', [
            'journey' => $journey,
            'users' => $users
        ]);
    }

    public function assign(Journey $journey, User $user)
    {
        $user->journey_id = $journey->id;
        $user->save();

        $users = User::get();
        return redirect()->route('crews.assignment', [
            'journey' => $journey,
            'users' => $users
        ])->with('success', 'User has been assigned.');
    }

    public function unassign(User $user)
    {
        $user->journey_id = null;
        $user->save();

        $users = User::get();
        return redirect()->route('crews.index' , [
            'users' => $users
        ])->with('success', 'User has been unassigned.');
    }
}
