@extends('layouts.main')

@section('content')

@include('alert')

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        {{--             // Fetch the users and journeys and then join it togater --}}
        @php
        $UserData = DB::table('users')
        ->join('journeys', 'users.journey_id', '=', 'journeys.id')
        ->where('users.id', Auth::user()->id)
        ->first();
        @endphp
        {{--            <pre>{{ json_encode($UserData , JSON_PRETTY_PRINT) }}</pre>--}}
        @if(Auth::user()->isAdmin())
        <h1 class="text-4xl mb-6 py-3 pl-12 text-white"><strong>Welcome to your Dashboard, ADMIN!</strong></h1>
        <div class="grid grid-cols-2 gap-4">
            <a href="{{ route('ships.index') }}" class="block p-10 text-5xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
                <div class="p-6 text-black text-center">
                    Manage Ship
                </div>
            </a>
            <a href="{{ route('containers.index') }}" class="block p-10 text-5xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
                <div class="p-6 text-black text-center">
                    Manage Containers
                </div>
            </a>
            <a href="{{ route('journeys.index') }}" class="block p-10 text-5xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
                <div class="p-6 text-black text-center">
                    Manage Journey
                </div>
            </a>

            <a href="{{ route('crews.index') }}" class="block p-10 text-5xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
                <div class="p-6 text-black text-center">
                    Manage Users
                </div>
            </a>
            @else
                @if(!Auth::user()->journey_id == null)
                <div class="grid grid-cols-2 gap-6">
                    <div class="gap-6">
                        <h1 class="text-4xl mb-6 py-3 pl-12 text-white"><strong>Welcome to your Dashboard, {{ $UserData->role }}!</strong></h1>
                        <h2 class="text-2xl mb-1 py-3 pl-12 text-white"><strong>Destination: {{ $UserData->destination }}</strong></h2>
                        <h2 class="text-2xl mb-6 py-3 pl-12 text-white"><strong>Journey ID: {{ $UserData->journey_id }}</strong></h2>
                    </div>
                    <div class="gap-6">
                        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                            @if( Auth::user()->imgPath !== null )
                            <img src="{{ asset('storage/' . Auth::user()->imgPath) }}" alt="Profile Picture" class="max-w-full h-3/4 object-contain rounded-full ">
                            @else
                            <img src="/images/defaultProfile.png" alt="avatar IMG" class="rounded-lg shadow-lg shadow-xl">
                            @endif
                        </div>
                    </div>
                </div>


                @php
                $users = DB::table('users')
                ->where('journey_id', Auth::user()->journey_id)
                ->where('role', 'CREW')
                ->get();

                $pendingCrew = $users->where('status', 'PENDING')->count();
                $notReadyCrew = $users->where('status', 'NOTREADY')->count();
                $readyCrew = $users->where('status', 'READY')->count();

                $journey = DB::table('journeys')
                ->where('id', Auth::user()->journey_id)
                ->first();

                $ship = DB::table('ships')
                ->where('id', $journey->ship_id)
                ->get();

                $containers = DB::table('containers')
                ->where('journey_id', Auth::user()->journey_id)
                ->get();

                $readyContainers = $containers->where('status', 'READY')->count();
                $notReadyContainers = $containers->where('status', 'MISSING')->count();
                $pendingContainers = $containers->where('status', 'PENDING')->count();

                $documents = DB::table('documents')
                ->where('journey_id', Auth::user()->journey_id)
                ->count();

                @endphp


                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('ships.view' , [ 'ship_id' => $UserData->ship_id ]) }}" class="block p-10  bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
                        <div class="p-6 text-black text-center">
                            <p class="text-5xl p-2"> Ship </p>
                            <p class="text-3xl"> Engine : {{ $ship[0]->engine_status }} </p>
                            <p class="text-3xl"> Fuel : {{ $ship[0]->fuel }} </p>
                        </div>
                    </a>
                    <a href="{{ route('containers.index') }}" class="block p-10  bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
                        <div class="p-6 text-black text-center">
                            <p class="text-5xl p-2"> Containers </p>
                            <p class="text-3xl"> Ready : {{ $readyContainers }} </p>
                            <p class="text-3xl"> Pending : {{ $pendingContainers }} </p>
                            <p class="text-3xl"> Missing : {{ $notReadyContainers }} </p>

                        </div>
                    </a>
                    <a href="{{ route('crews.index') }}" class="block p-10 text-5xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
                        <div class="p-6 text-black text-center">
                            <p class="text-5xl p-2"> Crews </p>
                            <p class="text-3xl"> Ready : {{ $readyCrew }} </p>
                            <p class="text-3xl"> Pending : {{ $pendingCrew }} </p>
                            <p class="text-3xl"> Missing : {{ $notReadyCrew }} </p>
                        </div>
                    </a>
                    <a href="{{ route('documents.index') }}" class="block p-10 text-5xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
                        <div class="p-6 text-black text-center">
                            <p class="text-5xl p-2"> Documents </p>
                            <p class="text-3xl"> Numbers of Document(s) : {{ $documents }} </p>
                        </div>
                    </a>
                    <div class="p-4 flex justify-between">
                        <a class="block p-2 text-xl bg-hex-color-010066 overflow-hidden shadow-sm sm:rounded-lg  transition duration-300 m-4">
                            <div class="p-2 text-black text-center">
                            </div>
                        </a>
                    </div>
                    @if(Auth::user()->role == 'CAPTAIN' and $journey->status == 'UPCOMING')
                    <a href="{{ route('journeys.ongoing', ['journey_id' => $UserData->journey_id ]) }}" class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
                        <div class="p-2 text-black text-center">
                            Start Trip >
                        </div>
                    </a>
                    @endif
                    @if(Auth::user()->role == 'CAPTAIN' and $journey->status == 'ONGOING')
                    <a href="{{ route('journeys.finish', ['journey_id' => $UserData->journey_id ]) }}" class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
                        <div class="p-2 text-black text-center">
                            Finish Trip >
                        </div>
                    </a>
                </div>
                        @endif
                    </div>
                    @else
                    <h1 class="text-4xl mb-6 py-3 pl-12 text-white"><strong>Welcome to your Dashboard, {{Auth::user()->role}}!</strong></h1>
                    <h2 class="text-2xl mb-1 py-3 pl-12 text-white"><strong>You currently have no journey!</strong></h2>
                    @endif
                @endif



    </div>

    @endsection
