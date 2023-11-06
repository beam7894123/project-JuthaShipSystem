@extends('layouts.main')

@section('content')

@include('alert')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
{{--             // Fetch the user data from the database --}}
            @php
                $UserData = DB::table('users')
                ->join('journeys', 'users.journey_id', '=', 'journeys.id')
                ->where('users.id', Auth::user()->id)
                ->first();


            @endphp
{{--            <pre>{{ json_encode($UserData , JSON_PRETTY_PRINT) }}</pre>--}}

{{--        Admin    ----------------------------------------------------------------------------------}}
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
{{--        Other User ----------------------------------------------------------------------------------}}
            @else
                    @if(!Auth::user()->journey_id == null)

{{--                    If the user is a captain show this -------------------------------------------------}}
                        @if(Auth::user()->isCAPTAIN())
                            @php
                                $users = DB::table('users')
                                ->where('journey_id', Auth::user()->journey_id)
                                ->where('role', 'CREW')
                                ->get();

                                $ship = DB::table('ships')
                                ->where('id', journeys()->ship_id) NEED FIX <---------------------------------------------------------------
                                ->get();
                            @endphp
                            <pre>{{ json_encode($ship , JSON_PRETTY_PRINT) }}</pre>
                            <div class="grid grid-cols-2 gap-6">
                                <div class="gap-6">
                                    <h1 class="text-4xl mb-6 py-3 pl-12 text-white"><strong>Welcome to your Dashboard, {{ $UserData->role }}!</strong></h1>
                                    <h2 class="text-2xl mb-1 py-3 pl-12 text-white"><strong>Destination: {{ $UserData->destination }}</strong></h2>
                                    <h2 class="text-2xl mb-6 py-3 pl-12 text-white"><strong>Journey ID: {{ $UserData->journey_id }}</strong></h2>
                                </div>
                                <div class="gap-6">
                                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                                        @if( Auth::user()->imgPath !== null )
                                            <img src="{{ asset('storage/' . Auth::user()->imgPath) }}" alt="Profile Picture" class="max-w-full h-3/4 object-contain rounded-full">
                                        @else
                                            <img src="/images/defaultProfile.png" alt="avatar IMG" class="rounded-lg shadow-lg shadow-xl">
                                        @endif
                                    </div>
                                </div>
                            </div>


                                <div class="w-1/2">
                                    <div id="ship_list" class="bg-white rounded-md max-w-full mx-auto mt-8 overflow-y-auto">
                                        <div class="bg-[#011147] py-2 px-4">
                                            <h2 class="text-xl font-semibold text-white">Ship details</h2>
                                        </div>
                                        <div class="p-4">
                                            <!-- Input zone for Model -->
                                            <div class="grid grid-cols-2 items-center p-6 text-3xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4 text-black">
                                                <div class="text-center font-semibold mb-4">Ship Model : {{ $ship->model }}</div>
                                            </div>

                                            <!-- Input zone for Engine Status -->
                                            <div class="grid grid-cols-2 items-center p-6 text-3xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4 text-black">
                                                <div class="text-center font-semibold mb-4">Engine Status : {{ $ship->engine_status }}</div>
                                            </div>

                                            <!-- Input zone for Fuel -->
                                            <div class="grid grid-cols-2 items-center p-6 text-3xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4 text-black">
                                                <div class="text-center font-semibold mb-4">Fuel : {{ $ship->fuel }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-1/2 p-4">
                                    <img src="{{ asset('images/JUTHA_MALEE_SHIP.png') }}" alt="JUTHA_MALEE_SHIP IMG" class="rounded-md shadow-lg hover:shadow-xl transition duration-300">
                                </div>
                </div>

{{--                            Show the list of crew members --------------------------------------------------}}
                                <div id="user_list" class="bg-white rounded-md max-w-full mx-auto mt-8">
                                    <div class="bg-[#011147] py-2 px-4">
                                        <h2 class="text-xl font-semibold text-white">Crew List</h2>
                                    </div>
                                    <div class="overflow-y-auto max-h-128">
                                        <ul class="divide-y divide-gray-200">
                                            @foreach ($users as $user)
                                                {{--                                                <pre>{{ json_encode($user , JSON_PRETTY_PRINT) }}</pre>--}}
                                                <li class="flex items-center py-4 px-6 hover:bg-[#819eff] transition duration-300">
                                                    <div class="flex-1">
                                                        <a href="{{ route("crews.view", ['user' => $user->id]) }}">
                                                            <h3 class="text-3xl font-medium text-gray-800">{{ $user->name }}</h3>
                                                            <h3 class="text-xl font-sm text-gray-800">{{ $user->status }}</h3>
                                                        </a>
                                                        <p class="text-gray-600 text-base"></p>
                                                    </div>
                                                    <span class="text-gray-400"></span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @error('user')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                    @enderror



{{--                            if the user is a crew show this ---------------------------------------------------}}
                                @else
                            <h1 class="text-4xl mb-6 py-3 pl-12 text-white"><strong>Welcome to your Dashboard, {{ $UserData->role }}!</strong></h1>
                            <h2 class="text-2xl mb-1 py-3 pl-12 text-white"><strong>Destination: {{ $UserData->destination }}</strong></h2>
                            <h2 class="text-2xl mb-6 py-3 pl-12 text-white"><strong>Journey ID: {{ $UserData->journey_id }}</strong></h2>

                            <div class="grid grid-cols-2 gap-4">
                                <a href="{{ route('ships.view' , [ 'ship_id' => $UserData->ship_id ]) }}" class="block p-10 text-5xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
                                    <div class="p-6 text-black text-center">
                                        Ship
                                    </div>
                                </a>
                                <a href="{{ route('containers.index') }}" class="block p-10 text-5xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
                                    <div class="p-6 text-black text-center">
                                        Containers
                                    </div>
                                </a>
                                <a href="{{ route('crews.index') }}" class="block p-10 text-5xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
                                    <div class="p-6 text-black text-center">
                                        Crew
                                    </div>
                                </a>
                                <a href="{{ route('documents.index') }}" class="block p-10 text-5xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
                                    <div class="p-6 text-black text-center">
                                        Documents
                                    </div>
                                </a>

                                @endif

{{--                            if the user has no journey show this --------------------------------------------------}}
                                @else
                                <h1 class="text-4xl mb-6 py-3 pl-12 text-white"><strong>Welcome to your Dashboard, {{Auth::user()->role}}!</strong></h1>
                                <h2 class="text-2xl mb-1 py-3 pl-12 text-white"><strong>You currently have no journey!</strong></h2>
                            @endif

    @endif
    </div>

</div>
            <div class="p-4 flex justify-between">
                <a class="block p-2 text-xl bg-hex-color-010066 overflow-hidden shadow-sm sm:rounded-lg  transition duration-300 m-4">
                    <div class="p-2 text-black text-center">
                    </div>
                </a>
                @if(Auth::user()->role == 'CAPTAIN' and !Auth::user()->journey_id == null)
                <a href="{{ route('journeys.finish', ['journey_id' => $UserData->journey_id ]) }}" class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
                    <div class="p-2 text-black text-center">
                        Finish Trip >
                    </div>
                </a>
                @endif
            </div>
</div>

@endsection
