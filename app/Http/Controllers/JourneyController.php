<?php

namespace App\Http\Controllers;

use App\Models\Journey;
use App\Models\Ship;
use App\Models\User;
use Illuminate\Http\Request;
use Psy\Util\Str;

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
            'start_date' => 'required|date',
            'arrival_date' => 'required|date|after:start_date',
            'destination' => 'required'
        ]);
        $ship = Ship::find($request->get('ship'));

        $journey = new Journey();
        $journey->start_date = $request->get('start_date');
        $journey->arrival_date = $request->get('arrive_date');
        $journey->destination = $request->get('destination');
        $journey->ship_id = $ship->id;
        $journey->status = "UPCOMING";

        $journey->save();

        return redirect()->route('journeys.view' , [
            'journey' => $journey
        ])->with('success', 'Your journey has been created.');
    }

    public function update(Request $request, Journey $journey)
    {
        $request->validate([
            'start_date' => 'required|date',
            'arrival_date' => 'required|date|after:start_date',
            'destination' => 'required',
            'status' => 'required'
        ]);
        $ship = Ship::find($request->get('ship'));

        $journey->start_date = $request->get('start_date');
        $journey->arrival_date = $request->get('arrive_date');
        $journey->destination = $request->get('destination');
        $journey->ship_id = $ship->id;
        $journey->status = $request->get('status');

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
            $user->save();
        }

        $ship = Ship::find($journey->ship_id);
        $ship->journey_id = null;
        $ship->save();

        return redirect()->route('dashboard')->with('success', 'Your journey has been completed.');
    }

}
