<?php

namespace App\Http\Controllers;

use App\Models\Journey;
use App\Models\Ship;
use App\Models\User;
use Illuminate\Http\Request;

class JourneyController extends Controller
{
    public function index()
    {
        $journeys = Journey::get();
        return view('journeys.index' , [
            'journeys' => $journeys
        ]);
    }

    public function create()
    {
        return view('journeys.create');
    }

    public function view(Journey $journey)
    {
        return view('journeys.view' , [
            'journey' => $journey
        ]);
    }

    public function edit(Journey $journey)
    {
        return view('journeys.edit' , [
            'journey' => $journey
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'start_date' => ['required'],
            'arrive_date' => ['required', 'after:start_date'],
            'destination' => ['required'],
        ]);

        $journey = new Journey();
        $journey->start_date = $request->get('start_date');
        $journey->arrive_date = $request->get('arrive_date');
        $journey->destination = $request->get('destination');
        $journey->status = "UPCOMING";

        $journey->save();

        $journeys = Journey::get();
        return redirect()->route('journeys.index' , [
            'journeys' => $journeys
        ])->with('success', 'Your journey has been created.');
    }

    public function update(Request $request, Journey $journey)
    {
        $request->validate([
            'start_date' => ['required'],
            'arrive_date' => ['required', 'after:start_date'],
            'destination' => ['required'],
        ]);

        $journey->start_date = $request->get('start_date');
        $journey->arrive_date = $request->get('arrive_date');
        $journey->destination = $request->get('destination');

        $journey->save();

        return redirect()->route('journeys.view' , [
            'journey' => $journey
        ])->with('success', 'Your journey has been updated.');
    }

    public function finish(String $journey_id)
    {
        $journey = Journey::find($journey_id);
        $journey->status = "COMPLETED";
        $journey->save();

        $users = User::where('journey_id' , $journey->id)->get();
        foreach ($users as $user) {
            $user->journey_id = null;
            $user->status = "PENDING";
            $user->save();
        }

        $ship = Ship::find($journey->ship_id);
        $ship->journey_id = null;
        $ship->engine_status = "PENDING";
        $ship->save();

        return redirect()->route('dashboard')->with('success', 'Your journey has been completed.');
    }

}
