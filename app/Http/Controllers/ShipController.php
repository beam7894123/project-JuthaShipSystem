<?php

namespace App\Http\Controllers;

use App\Models\Journey;
use App\Models\Ship;
use Illuminate\Http\Request;

class ShipController extends Controller
{
    public function index()
    {
        $ships = Ship::get();
        return view('ships.index', [
            'ships' => $ships
        ]);
    }

    public function create()
    {
        return view('ships.create');
    }

    public function view(String $ship_id)
    {
        $ship = Ship::where('id', $ship_id)->first();
        return view('ships.view', [
            'ship' => $ship
        ]);
    }

    public function edit(Ship $ship)
    {
        return view('ships.edit', [
            'ship' => $ship
        ]);
    }

    public function updatePage(Ship $ship)
    {
        return view('ships.update', [
            'ship' => $ship
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'model' => ['required', 'string', 'min:1'],
            'container_capacity' => ['required','integer', 'min:10'],
            'crew_capacity' => ['required','integer' ,'min:10']
        ]);

        $ship = New Ship();
        $ship->fuel = 0;
        $ship->model = $request->get('model');
        $ship->container_capacity = $request->get('container_capacity');
        $ship->crew_capacity = $request->get('crew_capacity');
        $ship->engine_status = 'PENDING';

        $ship->save();


        $ships = Ship::get();
        return redirect()->route('ships.index', [
            'ships' => $ships
        ])->with('success', 'Your ship has been created.');
    }

    public function update(Request $request, Ship $ship)
    {
        $request->validate([
            'model' => ['required', 'string', 'min:1'],
            'container_capacity' => ['required','integer', 'min:10'],
            'crew_capacity' => ['required','integer' ,'min:10']
        ]);

        $ship->model = $request->get('model');
        $ship->container_capacity = $request->get('container_capacity');
        $ship->crew_capacity = $request->get('crew_capacity');

        $ship->save();

        $ships = Ship::get();
        return redirect()->route('ships.index', [
            'ships' => $ships
        ])->with('success', 'Your ship has been updated.');
    }

    public function updateStatus(Request $request, Ship $ship)
    {
        $request->validate([
            'fuel' => ['required', 'integer', 'min:0', 'max:100'],
        ]);

        $ship->engine_status = $request->get('engine_status');
        $ship->fuel = $request->get('fuel');

        $ship->save();

        return redirect()->route('ships.view', [
            'ship_id' => $ship->id
        ])->with('success', 'Your ship has been updated.');
    }

    public function destroy(Ship $ship)
    {
        $ship->delete();

        return redirect()->route('ships.index')->with('success', 'Your ship has been deleted.');
    }

    public function assignment(Journey $journey)
    {
        $ships = Ship::where('journey_id', null)->get();
        $currentship = Ship::where('id', $journey->ship_id)->first();
        return view('ships.assignment', [
            'ships' => $ships,
            'journey' => $journey,
            'currentship' => $currentship
        ]);
    }

    public function assign(Journey $journey, Ship $ship)
    {
        if($journey->ship_id != null){
            $tempship = Ship::where('id', $journey->ship_id)->first();
            $tempship->journey_id = null;
            $tempship->save();
        }

        $journey->ship_id = $ship->id;
        $journey->save();

        $ship->journey_id = $journey->id;
        $ship->save();

        $ships = Ship::where('journey_id', null)->get();
        $currentship = Ship::where('id', $journey->ship_id)->first();
        return redirect()->route('ships.assignment', [
            'ships' => $ships,
            'journey' => $journey,
            'currentship' => $currentship
        ])->with('success', 'A ship has been assigned.');
    }

    public function unassign(Journey $journey, Ship $ship)
    {
        $journey->ship_id = null;
        $journey->save();
        $ship->journey_id = null;

        $ships = Ship::where('journey_id', null)->get();
        $currentship = Ship::where('id', $journey->ship_id)->first();
        return redirect()->route('ships.assignment', [
            'ships' => $ships,
            'journey' => $journey,
            'currentship' => $currentship
        ])->with('success', 'A ship has been unassigned.');
    }
}
