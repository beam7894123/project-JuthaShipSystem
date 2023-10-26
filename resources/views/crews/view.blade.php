@extends('layouts.main')

@section('content')
@include('alert')

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <h1 class="text-4xl mb-6 py-3 text-white">
            <strong>
                User Information
            </strong>
        </h1>
        <div class="grid grid-cols-2 gap-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <!-- Profile Image Upload -->
                <img src="{{ asset('images/JUTHA_MALEE_SHIP.png') }}" alt="avatar IMG" class="rounded-lg shadow-lg shadow-xl">
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <!-- Name Input -->
                <div class="mt-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <label class="text-base font-medium text-gray-700">{{ $user->name }}</label>

                </div>

                <!-- Email Input -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <label class="text-base font-medium text-gray-700">{{ $user->email }}</label>
                </div>

                <!-- Role Dropdown -->
                <div class="mt-4">
                    <x-input-label for="role" :value="__('Role')" />
                    <label class="text-base font-medium text-gray-700">{{ $user->role }}</label>
                </div>
            </div>
        </div>

        <div class="p-4 flex justify-between">
            <a href="{{ route('crews.index') }}" class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
                <div class="p-2 text-black text-center">
                    < Back
                </div>
            </a>
            <a href="{{ route('crews.edit', ['user' => $user]) }}" class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
                <div class="p-2 text-black text-center">
                    Edit >
                </div>
            </a>
        </div>
</div>
@endsection
