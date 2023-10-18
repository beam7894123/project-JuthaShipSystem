<?php

namespace App\Http\Controllers;

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

    public function view(Ship $ship)
    {
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
            'container_capacity' => ['required', 'min:10'],
            'crew_capacity' => ['required', 'min:10']
        ]);

        $ship = New Ship();
        $ship->fuel = 0;
        $ship->model = $request->get('model');
        $ship->container_capacity = $request->get('container_capacity');
        $ship->crew_capacity = $request->get('crew_capacity');
        $ship->engine_status = 'PENDING';

        $ship->save();

        return redirect()->route('ships.view', [
            'ship' => $ship
        ])->with('success', 'Your ship has been created.');
    }

    public function update(Request $request, Ship $ship)
    {
        $request->validate([
            'model' => ['required', 'string', 'min:1'],
            'container_capacity' => ['required', 'min:10'],
            'crew_capacity' => ['required', 'min:10'],
        ]);

        $ship->model = $request->get('model');
        $ship->container_capacity = $request->get('container_capacity');
        $ship->crew_capacity = $request->get('crew_capacity');

        $ship->save();

        return redirect()->route('ships.view', [
            'ship' => $ship
        ])->with('success', 'Your ship has been updated.');
    }

    public function updateStatus(Request $request, Ship $ship)
    {
        $request->validate([
            'engine_status' => ['required', 'string', 'min:1'],
            'fuel' => ['required', 'min:0'],
        ]);

        $ship->engine_status = $request->get('engine_status');

        $ship->save();

        return redirect()->route('ships.view', [
            'ship' => $ship
        ])->with('success', 'Your ship has been updated.');
    }

    public function destroy(Ship $ship)
    {
        $ship->delete();

        return redirect()->route('ships.index')->with('success', 'Your ship has been deleted.');
    }
}
