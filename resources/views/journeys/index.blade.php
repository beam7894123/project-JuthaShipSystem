@extends('layouts.main')

@section('content')
    @include('alert')
{{--    @php--}}
{{--        $journeys = DB::table('journeys')--}}
{{--            ->join('ships', 'journeys.ship_id', '=', 'ship_id')--}}
{{--            ->get();--}}
{{--    @endphp--}}
{{--    <pre>{{ json_encode($journeys , JSON_PRETTY_PRINT) }}</pre>--}}
<div id="user_list_notAdmin" class="bg-white rounded-md max-w-full mx-auto mt-8">
    <div class="bg-[#011147] py-2 px-4">
        <h2 class="text-xl font-semibold text-white">Journey List</h2>
    </div>
    <div class="overflow-y-auto max-h-128">
        <ul class="divide-y divide-gray-200">
            @foreach ($journeys as $journey)
                <li class="flex items-center py-4 px-6 hover:bg-[#819eff] transition duration-300">
                    <div class="flex-1">
                        <a href="{{ route('journeys.view', ['journey' => $journey]) }}">
                            <h3 class="text-3xl font-medium text-gray-800">{{ $journey->destination ?? 'Not Assigned yet' }} ( {{ $journey->status }} )</h3>
                            <h3 class="text-xl font-sm text-gray-800">Journey ID: {{ $journey->id }}</h3>
                            <h3 class="text-xl font-sm text-gray-800">{{ $journey->start_date ?? 'No Date' }} - {{ $journey->arrive_date ?? '' }}</h3>
                        </a>
                        <p class="text-gray-600 text-base"></p>
                    </div>
                    <span class="text-gray-400"></span>
                </li>
            @endforeach
        </ul>
    </div>
    @error('journey')
    <p class="text-red-500 text-sm">{{ $message }}</p>
    @enderror
</div>

<div class="p-4 flex justify-between">
    <a href="{{ route('dashboard') }}" class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
        <div class="p-2 text-black text-center">
            < Back
        </div>
    </a>
    <a href="{{ route('journeys.create') }}" class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
        <div class="p-2 text-green-800 text-center">
            MAKE NEW JOURNEY +
        </div>
    </a>
</div>

@endsection
