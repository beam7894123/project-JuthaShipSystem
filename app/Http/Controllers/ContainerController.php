<?php

namespace App\Http\Controllers;

use App\Models\Container;
use App\Models\Journey;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContainerController extends Controller
{
    public function index()
    {
        $containers = Container::where('journey_id', Auth::user()->journey_id)
            ->get();
        $containersForAdmin = Container::get();
        return view('containers.index' , [
            'containers' => $containers,
            'containersForAdmin' => $containersForAdmin
        ]);
    }

    public function edit(Container $container)
    {
        return view('containers.edit', [
            'container' => $container
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

        $container = new Container();
        $container->company_name = $request->get('company_name');
        $container->status = 'PENDING';

        $container->save();

        $containers = Container::get();
        return redirect()->route('containers.index' , [
            'containers' => $containers
        ])->with('success', 'Your container has been added.');
    }

    public function rename(Request $request, Container $container)
    {
        $request->validate([
            'company_name' => ['required', 'string', 'min:1']
        ]);

        $container->company_name = $request->get('company_name');
        $container->status = 'PENDING';

        $container->save();

        $containers = Container::get();
        return redirect()->route('containers.index' , [
            'containers' => $containers
        ])->with('success', 'Your container has been changed.');
    }
    public function update(Request $request, Container $container)
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

    public function pending(Container $container)
    {
        $container->status = 'PENDING';
        $container->save();

        $containers = Container::get();
        return redirect()->route('containers.index' , [
            'containers' => $containers
        ])->with('success', 'Your container has been updated.');
    }



    public function ready(Container $container)
    {
        $container->status = 'READY';
        $container->save();

        $containers = Container::get();
        return redirect()->route('containers.index' , [
            'containers' => $containers
        ])->with('success', 'Your container has been updated.');
    }

    public function missing(Container $container)
    {
        $container->status = 'MISSING';
        $container->save();

        $containers = Container::get();
        return redirect()->route('containers.index' , [
            'containers' => $containers
        ])->with('success', 'Your container has been updated.');
    }



    public function assignment(Journey $journey)
    {
        $containers = Container::where('journey_id', null)
            ->get();
        $currentcontainers = Container::where('journey_id', $journey->id)
            ->get();

        return view('containers.assignment', [
            'journey' => $journey,
            'containers' => $containers,
            'currentcontainers' => $currentcontainers,
        ]);
    }

    public function assign(Journey $journey, Container $container)
    {
        $container->journey_id = $journey->id;
        $container->save();

        $containers = Container::where('journey_id', null)
            ->get();
        $currentcontainers = Container::where('journey_id', $journey->id)
            ->get();
        return redirect()->route('containers.assignment' , [
            'journey' => $journey,
            'containers' => $containers,
            'currentcontainers' => $currentcontainers,
        ])->with('success', 'Your container has been assigned.');
    }

    public function unassign(Journey $journey, Container $container)
    {
        $container->journey_id = null;
        $container->save();

        $containers = Container::where('journey_id', null)
            ->get();
        $currentcontainers = Container::where('journey_id', $journey->id)
            ->get();

        return redirect()->route('containers.assignment' , [
            'journey' => $journey,
            'containers' => $containers,
            'currentcontainers' => $currentcontainers,
        ])->with('success', 'Your container has been unassigned.');
    }
}
