@extends('layouts.main')

@section('content')
@include('alert')
<div class="flex justify-center items-center">
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

<div class="p-4 flex justify-between">
    <a href="{{ route('dashboard') }}" class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
        <div class="p-2 text-black text-center">
            < Back
        </div>
    </a>
    @if(Auth::user()->role == 'CAPTAIN' or Auth::user()->role == 'ENGINEER')
        <a href="{{ route('ships.updatePage', ['ship' => $ship ]) }}" class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
            <div class="p-2 text-black text-center">
                Update >
            </div>
        </a>
    @endif
</div>
</div>
@endsection
