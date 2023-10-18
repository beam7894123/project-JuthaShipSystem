<?php

namespace App\Http\Controllers;

use App\Models\Container;
use App\Models\Journey;
use Illuminate\Http\Request;

class ContainerController extends Controller
{
    public function index()
    {
        $containers = Container::get();
        return view('containers.index' , [
            'containers' => $containers
        ]);
    }

    public function create()
    {
        return view('containers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => ['required', 'string', 'min:1']
        ]);
        $journey = Journey::find($request->get('journey'));

        $container = new Container();
        $container->journey_id = $journey->id;
        $container->company_name = $request->get('company_name');
        $container->status = 'PENDING';

        $container->save();

        $containers = Container::get();
        return redirect()->route('containers.index' , [
            'containers' => $containers
        ])->with('success', 'Your container has been added.');
    }

    public function update(Request $request, Container $container, Journey $journey)
    {
        $request->validate([
            'status' => ['required', 'string', 'min:1']
        ]);

        $container->status = $request->get('status');

        $container->save();

        $containers = Container::get();
        return redirect()->route('containers.index' , [
            'containers' => $containers
        ])->with('success', 'Your container has been updated.');
    }

    public function destroy(Container $container)
    {
        $container->delete();

        $containers = Container::get();
        return redirect()->route('containers.index' , [
            'containers' => $containers
        ])->with('success', 'Your container has been deleted.');
    }
}
