@extends('layouts.main')

@section('content')
    @include('alert')

    <h1 class="text-4xl mb-6 py-3 pl-12 text-white"><strong>You are Managing Journey ID: {{ $journey->id }} ({{ $journey->status}})</strong></h1>
    <h2 class="text-2xl mb-1 py-3 pl-12 text-white"><strong>Destination: {{ $journey->destination  ?? 'Not Assigned yet' }}</strong></h2>
    <h2 class="text-2xl mb-6 py-3 pl-12 text-white"><strong>{{ $journey->start_date ?? 'No Date' }} - {{ $journey->arrive_date ?? '' }}</strong></h2>

    <div class="grid grid-cols-2 gap-4">
        <a href="{{ route('ships.assignment', [ 'journey' => $journey ]) }}" class="block p-10 text-5xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
            <div class="p-6 text-black text-center">
                Ship
            </div>
        </a>
        <a href="{{ route('containers.assignment', [ 'journey' => $journey ]) }}" class="block p-10 text-5xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
            <div class="p-6 text-black text-center">
                Containers
            </div>
        </a>
        @if($journey->status == 'UPCOMING')
        <a href="{{ route('crews.assignment', [ 'journey' => $journey ]) }}" class="block p-10 text-5xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
            <div class="p-6 text-black text-center">
                Crew
            </div>
        </a>
        @endif
        @if($journey->status == 'UPCOMING')
        <a href="{{ route('journeys.edit', [ 'journey' => $journey ]) }}" class="block p-10 text-5xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
            <div class="p-6 text-black text-center">
                Edit Journey
            </div>
        </a>
        @else
        <a href="{{ route('journeys.edit', [ 'journey' => $journey ]) }}" class="block p-10 text-5xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
            <div class="p-6 text-black text-center">
                Journey Details
            </div>
        </a>
        @endif
    </div>

        <div class="p-4 flex justify-between">
            <a href="{{ route('journeys.index') }}" class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
                <div class="p-2 text-black text-center">
                    < Back
                </div>
            </a>
        </div>
@endsection
