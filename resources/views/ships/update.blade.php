@extends('layouts.main')

@section('content')
<form action="{{ route('ships.updateStatus', ['ship' => $ship]) }}" method="POST" enctype="multipart/form-data">
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
                        <div class="text-center font-semibold mb-4">Ship Model : {{ $ship->model }}</div>
                    </div>

                    <!-- Input zone for Engine Status -->
                    <div class="grid grid-cols-2 items-center p-6 text-3xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4 text-black">
                        <div class="text-center font-semibold mb-4">Engine Status </div>
                        <select class="form-control m-bot15" name="engine_status" id="engine_status">
                            <option value="PENDING">Pending</option>
                            <option value="READY">Ready</option>
                            <option value="DOWN">Not Ready</option>
                        </select>
                    </div>

                    <!-- Input zone for Fuel -->
                    <div class="grid grid-cols-2 items-center p-6 text-3xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4 text-black">
                        <div class="text-center font-semibold mb-4">Fuel
                            @error('fuel')
                            <div class="text-red-600 text-sm">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <input required type="integer" id="fuel" name ="fuel" class="block w-full p-4 bg-white border rounded-md focus:outline-none focus:ring-2 focus:ring-[#c0cfff] @error('fuel') border-red-600 @enderror"
                               placeholder="Insert fuel percentage in tank" value={{$ship->fuel}} />
                    </div>
                </div>
            </div>
        </div>

        <div class="w-1/2 p-4">
            <img src="{{ asset('images/JUTHA_MALEE_SHIP.png') }}" alt="JUTHA_MALEE_SHIP IMG" class="rounded-md shadow-lg hover:shadow-xl transition duration-300">
        </div>
    </div>

        <div class="p-4 flex justify-between">
            <a href="{{ route('ships.view', ['ship_id' => $ship->id ]) }}" class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover.bg-[#c0cfff] transition duration-300 m-4">
                <div class="p-2 text-black text-center">
                    < Back
                </div>
            </a>
            <button type="submit" class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover.bg-[#c0cfff] transition duration-300 m-4">
                Confirm >
            </button>
        </div>


</form>
@endsection
