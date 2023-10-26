@extends('layouts.main')

@section('content')
@include('alert')
<form action="{{ route('journeys.store') }}" method="post" class="mt-6 space-y-6" enctype="multipart/form-data">
    @csrf
    <div class="flex justify-center items-center">
        <div class="w-1/2">
            <div id="ship_list" class="bg-white rounded-md max-w-full mx-auto mt-8 overflow-y-auto">
                <div class="bg-[#011147] py-2 px-4">
                    <h2 class="text-xl font-semibold text-white">Create Journey details</h2>
                </div>

                <div class="p-4">
                    <div class="grid grid-cols-2 items-center p-6 text-3xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4 text-black">
                        <label for="start_date" class="text-xl font-medium text-gray-900 block mb-2">Start Date</label>
                        <input id="start_date" type="date" name="start_date" value="<?php echo date('Y-m-d'); ?>" />
                    </div>

                    <div class="grid grid-cols-2 items-center p-6 text-3xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4 text-black">
                        <label for="start_date" class="text-xl font-medium text-gray-900 block mb-2">Arrive Date</label>
                        <input id="arrive_date" type="date" name="arrive_date" />
                    </div>

                    <div class="grid grid-cols-2 items-center p-6 text-3xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4 text-black">
                        <label for="category" class="text-xl font-medium text-gray-900 block mb-2">Destination:</label>
                        <input type="text" name="destination" id="destination" class="block w-full p-4 bg-white border rounded-md focus:outline-none focus:ring-2 focus:ring-[#c0cfff]" placeholder="destination name"/>
                    </div>
                </div>
            </div>

        </div>
        <div class="w-1/2 p-4">
            <img src="{{ asset('images/JUTHA_MALEE_SHIP.png') }}" alt="JUTHA_MALEE_SHIP IMG" class="rounded-md shadow-lg hover:shadow-xl transition duration-300">
        </div>
    </div>

    <div class="p-4 flex justify-between">
        <a href="{{ route('journeys.index') }}" class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
            <div class="p-2 text-black text-center">
                < Back
            </div>
        </a>
        <button type="submit" class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
            Save >
        </button>
    </div>
    </div>
</form>
@endsection
