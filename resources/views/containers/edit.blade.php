@extends('layouts.main')
@include('alert')
@section('content')
<form action="{{ route('containers.rename', ['container' => $container]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="flex justify-center items-center">
        <div class="w-1/2">
            <div id="ship_list" class="bg-white rounded-md max-w-full mx-auto mt-8 overflow-y-auto">
                <div class="bg-[#011147] py-2 px-4">
                    <h2 class="text-xl font-semibold text-white">Container details</h2>
                </div>
                <div class="p-4">
                    <!-- Input zone for company_name -->
                    <div class="grid grid-cols-2 items-center p-6 text-3xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4 text-black">
                        <div class="text-center font-semibold mb-4">Company name</div>
                        <x-text-input type="text" id="company_name" name="company_name" class="block p-4 bg-white border rounded-md focus:outline-none focus:ring-2 focus:ring-[#c0cfff] " placeholder="your company name" :value="old('company_name', $container->company_name)" />
                        <x-input-error class="mt-2" :messages="$errors->get('company_name')" />
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="p-4 flex justify-between">
        <a href="{{ route('containers.index') }}" class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
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
