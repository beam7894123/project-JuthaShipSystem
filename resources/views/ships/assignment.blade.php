@extends('layouts.main')

@section('content')
    @include('alert')
@if($currentship)
    <div id="user_list_notAdmin" class="bg-white rounded-md max-w-full mx-32 mt-8">
        <div class="bg-[#011147] py-2 px-4">
            <h2 class="text-xl font-semibold text-white">Ship Inuse</h2>
        </div>
        <div class="overflow-y-auto max-h-auto">
            <ul class="divide-y divide-gray-200">
                    <li class="flex items-center py-4 px-6 hover:bg-[#819eff] transition duration-300">
                        <div class="flex-1">
                            <a>
                                <h3 class="text-3xl font-medium text-gray-800">{{ $currentship->model }}</h3>
{{--                                <h3 class="text-xl font-sm text-gray-800">{{ $currentship->status }}</h3>--}}
{{--                                            <pre>{{ json_encode($currentship , JSON_PRETTY_PRINT) }}</pre>--}}
                            </a>
                            <p class="text-gray-600 text-base"></p>
                        </div>
                        <span class="text-gray-400"></span>
                        @if($journey->status == 'UPCOMING')
                        <div class="grid grid-cols-2 gap-4 p-4">
                                <a href="{{ route('ships.unassign', ['journey' => $journey, 'ship' => $currentship ]) }}"
                                   class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg bg-[#c0cfff] hover:bg-red-500 transition duration-300 m-4">
                                    <div class="p-6 text-black text-center">
                                        Unassign
                                    </div>
                                </a>
                        </div>
                        @endif
                    </li>
            </ul>
        </div>
        @error('user')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>
@endif
@if(!$currentship)
    <div id="user_list_notAdmin" class="bg-white rounded-md max-w-full mx-32 mt-8">
        <div class="bg-[#011147] py-2 px-4">
            <h2 class="text-xl font-semibold text-white">Ship List</h2>
        </div>
        <div class="overflow-y-auto max-h-128">
            <ul class="divide-y divide-gray-200">
                @foreach ($ships as $ship)
                    <li class="flex items-center py-4 px-6 hover:bg-[#819eff] transition duration-300">
                        <div class="flex-1">
                            <p href="{{ route('ships.edit', ['ship' => $ship]) }}">
                                <h3 class="text-3xl font-medium text-gray-800">{{ $ship->model }}</h3>
                                <h3 class="text-xl font-sm text-gray-800">{{ $ship->status }}</h3>
                            </p>
                            <p class="text-gray-600 text-base"></p>
                        </div>
                        <span class="text-gray-400"></span>
                        <div class="grid grid-cols-2 gap-4 p-4">
                            <a href="{{ route('ships.assign', ['journey' => $journey, 'ship' => $ship ]) }}"
                               class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg bg-[#c0cfff] hover:bg-green-500 transition duration-300 m-4">
                                <div class="p-6 text-black text-center">
                                    Assign
                                </div>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        @endif
        @error('user')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <div class="p-4 flex justify-between">
        <a href="{{ route('journeys.view', ['journey' => $journey]) }}" class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
            <div class="p-2 text-black text-center">
                < Back
            </div>
        </a>
    </div>
@endsection
