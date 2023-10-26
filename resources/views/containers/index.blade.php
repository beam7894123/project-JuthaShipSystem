@extends('layouts.main')

@section('content')
    @include('alert')
    {{--   ADMIN ----------------------------------------------}}
    @if(Auth::user()->isAdmin())
    <div id="list_Admin" class="bg-white rounded-md max-w-full mx-auto mt-8">
        <div class="bg-[#011147] py-2 px-4">
            <h2 class="text-xl font-semibold text-white">Container List</h2>
        </div>
        <div class="overflow-y-auto max-h-128">
            <ul class="divide-y divide-gray-200">
                @foreach ($containersForAdmin as $container)
                    <li class="flex items-center py-4 px-6 hover:bg-[#819eff] transition duration-300">
                        <div class="flex-1">
                            <a href="{{ route('containers.edit', ['container' => $container->id]) }}">
                                <h3 class="text-3xl font-medium text-gray-800">{{ $container->company_name ?? 'Not assigned' }} (Container ID: {{ $container->id }})</h3>
                                <h3 class="text-xl font-sm text-gray-800">journey id: {{ $container->journey_id  ?? 'Not assigned' }}</h3>
                                <h3 class="text-xl font-sm text-gray-800">Destination: {{ $container->journey->destination  ?? 'Not assigned' }}</h3>
                            </a>
                            <p class="text-gray-600 text-base"></p>
                        </div>
                        <span class="text-gray-400"></span>
                        {{--                            <div class="grid grid-cols-2 gap-4 p-4">--}}
                        {{--                                @if($user->status !== 'PENDING')--}}
                        {{--                                    <a href="{{ route('crews.pending', ['user' => $user]) }}"--}}
                        {{--                                       class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg bg-[#c0cfff] hover:bg-white transition duration-300 m-4">--}}
                        {{--                                        <div class="p-6 text-black text-center">--}}
                        {{--                                            Pending--}}
                        {{--                                        </div>--}}
                        {{--                                    </a>--}}
                        {{--                                @endif--}}
                        {{--                                @if($user->status !== 'READY')--}}
                        {{--                                    <a href="{{ route('crews.ready', ['user' => $user]) }}"--}}
                        {{--                                       class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg bg-[#c0cfff] hover:bg-green-500 transition duration-300 m-4">--}}
                        {{--                                        <div class="p-6 text-black text-center">--}}
                        {{--                                            Ready--}}
                        {{--                                        </div>--}}
                        {{--                                    </a>--}}
                        {{--                                @endif--}}
                        {{--                                @if($user->status !== 'NOTREADY')--}}
                        {{--                                    <a href="{{ route('crews.pending', ['user' => $user]) }}"--}}
                        {{--                                       class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg bg-[#c0cfff] hover:bg-red-500 transition duration-300 m-4">--}}
                        {{--                                        <div class="p-6 text-black text-center">--}}
                        {{--                                            Not Ready--}}
                        {{--                                        </div>--}}
                        {{--                                    </a>--}}
                        {{--                                @endif--}}
                        {{--                            </div>--}}
                    </li>
                @endforeach
            </ul>
        </div>
        @error('user')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <div class="p-4 flex justify-between">
        <a href="{{ route('dashboard') }}" class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
            <div class="p-2 text-black text-center">
                < Back
            </div>
        </a>
        <a href="{{ route('containers.create') }}" class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
            <div class="p-2 text-green-800 text-center">
                MAKE NEW CONTAINER +
            </div>
        </a>
    </div>

    {{--   CREW ----------------------------------------------}}
    @else
        <div id="user_list_notAdmin" class="bg-white rounded-md max-w-full mx-auto mt-8">
            <div class="bg-[#011147] py-2 px-4">
                <h2 class="text-xl font-semibold text-white">Container List</h2>
            </div>
            <div class="overflow-y-auto max-h-128">
                <ul class="divide-y divide-gray-200">
                    @foreach ($containers as $container)
                        <li class="flex items-center py-4 px-6 hover:bg-[#819eff] transition duration-300">
                            <div class="flex-1">
                                @if(Auth::user()->role == 'ADMIN')
                                    <a href="{{ route('containers.edit', ['container' => $container->id]) }}">
                                        <h3 class="text-3xl font-medium text-gray-800">{{ $container->company_name ?? 'Not assigned' }}</h3>
                                        <h3 class="text-xl font-sm text-gray-800">Status: {{ $container->status}}</h3>
                                        <h3 class="text-xl font-sm text-gray-800">Container ID: {{ $container->id}}</h3>
                                    </a>
                                @else
                                <p href="{{ route('containers.edit', ['container' => $container->id]) }}">
                                    <h3 class="text-3xl font-medium text-gray-800">{{ $container->company_name ?? 'Not assigned' }}</h3>
                                    <h3 class="text-xl font-sm text-gray-800">Status: {{ $container->status}}</h3>
                                    <h3 class="text-xl font-sm text-gray-800">Container ID: {{ $container->id}}</h3>
                                </p>
                                @endif
                                <p class="text-gray-600 text-base"></p>
                            </div>
                            <span class="text-gray-400"></span>

                            @if(Auth::user()->role == 'CAPTAIN')
                                <div class="grid grid-cols-2 gap-4 p-4">
                                    @if($container->status !== 'PENDING')
                                        <a href="{{ route('containers.pending', ['container' => $container]) }}"
                                           class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg bg-[#c0cfff] hover:bg-white transition duration-300 m-4">
                                            <div class="p-6 text-black text-center">
                                                Pending
                                            </div>
                                        </a>
                                    @endif
                                    @if($container->status !== 'READY')
                                        <a href="{{ route('containers.ready', ['container' => $container]) }}"
                                           class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg bg-[#c0cfff] hover:bg-green-500 transition duration-300 m-4">
                                            <div class="p-6 text-black text-center">
                                                Ready
                                            </div>
                                        </a>
                                    @endif
                                    @if($container->status !== 'MISSING')
                                        <a href="{{ route('containers.missing', ['container' => $container]) }}"
                                           class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg bg-[#c0cfff] hover:bg-red-500 transition duration-300 m-4">
                                            <div class="p-6 text-black text-center">
                                                MISSING
                                            </div>
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
            @error('user')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="p-4 flex justify-between">
            <a href="{{ route('dashboard') }}" class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
                <div class="p-2 text-black text-center">
                    < Back
                </div>
            </a>
        </div>
    @endif

@endsection
