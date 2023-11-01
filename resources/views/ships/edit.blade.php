@extends('layouts.main')
@include('alert')
@section('content')
<form action="{{ route('ships.update', ['ship' => $ship]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="flex justify-center items-center">
        <div class="w-1/2">
            <div id="ship_list" class="bg-white rounded-md max-w-full mx-auto mt-8 overflow-y-auto">
                <div class="bg-[#011147] py-2 px-4">
                    <h2 class="text-xl font-semibold text-white">Ship details</h2>
                </div>
                <div class="p-4">
                    <!-- Input zone for Model -->
                    <div class="grid grid-cols-2 items-center p-6 text-3xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4 text-black">
                        <div class="text-center font-semibold mb-4">Ship Model</div>
                        <input type="text" name="model" id="model" class="block p-4 bg-white border rounded-md focus:outline-none focus:ring-2 focus:ring-[#c0cfff] " placeholder="Model" value={{ $ship->model }}>
                        <x-input-error class="mt-2" :messages="$errors->get('model')" />
                    </div>

                    <!-- Input zone for Crew Capacity -->
                    <div class="grid grid-cols-2 items-center p-6 text-3xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4 text-black">
                        <div class="text-center font-semibold mb-4">Crew Capacity</div>
                        <input type="integer" name="crew_capacity" id="crew_capacity" class="block w-full p-4 bg-white border rounded-md focus:outline-none focus:ring-2 focus:ring-[#c0cfff]" placeholder="Crew Capacity" value="{{ $ship->crew_capacity }}"/>
                        <x-input-error class="mt-2" :messages="$errors->get('crew_capacity')" />
                    </div>

                    <!-- Input zone for Container -->
                    <div class="grid grid-cols-2 items-center p-6 text-3xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4 text-black">
                        <div class="text-center font-semibold mb-4">Container Capacity</div>
                        <input type="integer" name="container_capacity" id="container_capacity" class="block w-full p-4 bg-white border rounded-md focus:outline-none focus:ring-2 focus:ring-[#c0cfff]" placeholder="Container Capacity" value="{{ $ship->container_capacity }}"/>
                        <x-input-error class="mt-2" :messages="$errors->get('container_capacity')" />
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="p-4 flex justify-between">
        <a href="{{ route('ships.index') }}" class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
            <div class="p-2 text-black text-center">
                < Back
            </div>
        </a>
        <button type="submit" class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
            Confirm >
        </button>
    </div>
</form>
@endsection
