@extends('layouts.main')

@section('content')
{{--    @include('alert')--}}
{{--   ADMIN ----------------------------------------------}}
    @if(Auth::user()->isAdmin())
        <div id="user_list" class="bg-white rounded-md max-w-full mx-auto mt-8">
            <div class="bg-[#011147] py-2 px-4">
                <h2 class="text-xl font-semibold text-white">USER List</h2>
            </div>
            <div class="overflow-y-auto max-h-128">
                <ul class="divide-y divide-gray-200">
                    @foreach ($usersForAdmin as $user)
                        <li class="flex items-center py-4 px-6 hover:bg-[#c0cfff] transition duration-300">
                            <div class="flex-1">
                                <a href="{{ route('crews.index', ['user' => $user]) }}">
                                    <h3 class="text-lg font-medium text-gray-800">{{ $user->name }}, {{ $user->role }}</h3>
                                </a>
                                <p class="text-gray-600 text-base"></p>
                            </div>
                            <span class="text-gray-400"></span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="p-4 flex justify-between">
            <a href="{{ route('dashboard') }}" class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
                <div class="p-2 text-black text-center">
                    < Back
                </div>
            </a>
            <a href="{{ route('containers.index') }}" class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
                <div class="p-2 text-green-800 text-center">
                    MAKE NEW USER +
                </div>
            </a>
        </div>
{{--   USER ----------------------------------------------}}
    @else
        <div id="user_list_notAdmin" class="bg-white rounded-md max-w-full mx-auto mt-8">
            <div class="bg-[#011147] py-2 px-4">
                <h2 class="text-xl font-semibold text-white">Crew List</h2>
            </div>
            <div class="overflow-y-auto max-h-128">
                <ul class="divide-y divide-gray-200">
                    @foreach ($users as $user)
                        <li class="flex items-center py-4 px-6 hover:bg-[#c0cfff] transition duration-300">
                            <div class="flex-1">
                                <a href="{{ route('crews.index', ['user' => $user]) }}">
                                    <h3 class="text-3xl font-medium text-gray-800">{{ $user->name }}</h3>
                                    <h3 class="text-xl font-sm text-gray-800">{{ $user->status }}</h3>
                                </a>
                                <p class="text-gray-600 text-base"></p>
                            </div>
                            <span class="text-gray-400"></span>


                                <div class="grid grid-cols-2 gap-4 p-4">
                                    @if($user->status !== 'PENDING')
                                        <a href="{{  route('crews.pending' , ['user' => $user]) }}" class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
                                            <div class="p-6 text-black text-center">
                                                Pending
                                            </div>
                                        </a>
                                    @endif

                                </div>
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
            <button type="submit" class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
                Save >
            </button>
        </div>
    @endif

@endsection
