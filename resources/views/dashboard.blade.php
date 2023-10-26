@extends('layouts.main')

@section('content')

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
                            @else
                            <h1 class="text-4xl mb-6 py-3 pl-12 text-white"><strong>Welcome to your Dashboard, {{Auth::user()->role}}!</strong></h1>
                            <h2 class="text-2xl mb-1 py-3 pl-12 text-white"><strong>You currently have no journey!</strong></h2>
                            @endif
    @endif

    </div>
</div>
</div>
@endsection
