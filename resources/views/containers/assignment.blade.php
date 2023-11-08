@extends('layouts.main')

@section('content')
    @if( $journey->ship_id != null)
        @include('alert')
        <div id="user_list_notAdmin" class="bg-white rounded-md max-w-full mx-32 mt-8">
            @php
            $tempcontainers = App\Models\Container::where('journey_id', $journey->id)->get();
            $ship = App\Models\Ship::where('id', $journey->ship_id)->first();
            @endphp
            <div class="bg-[#011147] py-2 px-4">
                <h2 class="text-xl font-semibold text-white">Assigned Container list</h2>
                <h1 class="text-xl font-semibold text-white">{{ $tempcontainers->count() }} / {{ $ship->container_capacity }}</h1>
            </div>
            <div class="overflow-y-auto max-h-128">
                <ul class="divide-y divide-gray-200">
                    @foreach ($currentcontainers as $currentcontainer)
                    <li class="flex items-center py-4 px-6 hover:bg-[#819eff] transition duration-300">
                        <div class="flex-1">
                            <p>
                            <h3 class="text-3xl font-medium text-gray-800">{{ $currentcontainer->company_name ?? 'Not assigned' }} (Container ID: {{ $currentcontainer->id }})</h3>
                            <h3 class="text-xl font-sm text-gray-800">journey id: {{ $currentcontainer->journey_id  ?? 'Not assigned' }}</h3>
                            <h3 class="text-xl font-sm text-gray-800">Destination: {{ $currentcontainer->journey->destination  ?? 'Not assigned' }}</h3>
                            </p>
                            <p class="text-gray-600 text-base"></p>
                        </div>
                        <span class="text-gray-400"></span>
                        @if($journey->status == 'UPCOMING')
                        <a href="{{ route('containers.unassign', ['journey' => $journey, 'container' => $currentcontainer ]) }}"
                           class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg bg-[#c0cfff] hover:bg-red-500 transition duration-300 m-4">
                            <div class="p-6 text-black text-center">
                                Unassign
                            </div>
                        </a>
                        @endif
                    </li>
                    @endforeach
                </ul>
                @error('user')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
        </div>
        @if( $journey->status == 'UPCOMING')
            @if( $tempcontainers->count() < $ship->container_capacity and $containers->count() > 0)
            <div id="user_list_notAdmin" class="bg-white rounded-md max-w-full mx-32 mt-8">
                <div class="bg-[#011147] py-2 px-4">
                    <h2 class="text-xl font-semibold text-white">Container list</h2>
                </div>
                <div class="overflow-y-auto max-h-128">
                    <ul class="divide-y divide-gray-200">
                        @foreach ($containers as $container)
                        <li class="flex items-center py-4 px-6 hover:bg-[#819eff] transition duration-300">
                            <div class="flex-1">
                                <p>
                                <h3 class="text-3xl font-medium text-gray-800">{{ $container->company_name ?? 'Not assigned' }} (Container ID: {{ $container->id }})</h3>
                                <h3 class="text-xl font-sm text-gray-800">journey id: {{ $container->journey_id  ?? 'Not assigned' }}</h3>
                                <h3 class="text-xl font-sm text-gray-800">Destination: {{ $container->journey->destination  ?? 'Not assigned' }}</h3>
                                </p>
                                <p class="text-gray-600 text-base"></p>
                            </div>
                            <span class="text-gray-400"></span>
                            <a href="{{ route('containers.assign', ['journey' => $journey, 'container' => $container ]) }}"
                               class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg bg-[#c0cfff] hover:bg-green-500 transition duration-300 m-4">
                                <div class="p-6 text-black text-center">
                                    Assign
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @error('user')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            @endif
        @endif
@else
<h1 class="text-2xl mb-1 py-3 pl-12 text-white"><strong>Please assign ship to current journey first!</strong></h1>
@endif

        <div class="p-4 flex justify-between">
            <a href="{{ route('journeys.view', ['journey' => $journey]) }}" class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
                <div class="p-2 text-black text-center">
                    < Back
                </div>
            </a>
        </div>

@endsection
