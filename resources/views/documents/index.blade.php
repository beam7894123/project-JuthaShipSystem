{{--@extends('layouts.main')--}}

{{--@section('content')--}}
{{--    @include('alert')--}}
{{--    <div class="p-4 flex justify-between">--}}
{{--        <a href="{{ route('dashboard') }}" class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">--}}
{{--            <div class="p-2 text-black text-center">--}}
{{--                < Back--}}
{{--            </div>--}}
{{--        </a>--}}
{{--    </div>--}}
{{--        <div id="list" class="bg-white rounded-md max-w-full mx-auto mt-8">--}}
{{--            <div class="bg-[#011147] py-2 px-4">--}}
{{--                <h2 class="text-xl font-semibold text-white">Documents List</h2>--}}
{{--            </div>--}}
{{--            <div class="overflow-y-auto max-h-208">--}}
{{--                <ul class="divide-y divide-gray-200">--}}
{{--                    @foreach ($documents as $document)--}}
{{--                        <li class="flex items-center py-4 px-6 hover:bg-[#819eff] transition duration-300">--}}
{{--                            <div class="flex-1 items-center">--}}

{{--                                    <img src="{{ asset($document->imagePath) }}" alt="IMG" class="rounded-lg shadow-lg shadow-xl h-192 " style="max-width: 100%; max-height: 100%;" />--}}
{{--                                    <h3 class="text-3xl font-medium text-gray-800">{{ $document->status }}</h3>--}}
{{--                                <p class="text-gray-600 text-base"></p>--}}
{{--                            </div>--}}

{{--                            <span class="text-gray-400"></span>--}}


{{--                            <div class="grid grid-cols-2 gap-4 p-4">--}}
{{--                                @if($document->status !== 'APPROVED')--}}
{{--                                    <a href="{{ route('documents.approved', ['document' => $document]) }}"--}}
{{--                                       class="block p-2 text-xl bg-white  shadow-sm sm:rounded-lg bg-[#c0cfff] hover:bg-green-500 transition duration-300 m-4">--}}
{{--                                        <div class="p-6 text-black text-center">--}}
{{--                                            APPROVED--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                                @if($document->status !== 'PENDING')--}}

{{--                                    <a href="{{ route('documents.pending', ['document' => $document]) }}"--}}
{{--                                       class="block p-2 text-xl bg-white shadow-sm sm:rounded-lg bg-[#c0cfff] hover:bg-red-500 transition duration-300 m-4">--}}
{{--                                        <div class="p-6 text-black text-center">--}}
{{--                                            PENDING--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--            @error('user')--}}
{{--            <p class="text-red-500 text-sm">{{ $message }}</p>--}}
{{--            @enderror--}}
{{--        </div>--}}

{{--        <div class="p-4 flex justify-between">--}}
{{--            <a href="{{ route('dashboard') }}" class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">--}}
{{--                <div class="p-2 text-black text-center">--}}
{{--                    < Back--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}

{{--@endsection--}}


@extends('layouts.main')
@include('alert')
@section('content')
    <div class="mt-4 w-full">
        <h1 class="text-2xl font-medium text-center text-white">Documents</h1>
        <div class="border-b border-gray-400 mt-4"></div>
        <div class="mx-6 my-4 flex flex-col">
            <!-- INSERT HERE!!! -->

            <form method="POST" action="{{route('dashboard')}}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <!-- Upload Files Form -->
                <div class="w-auto h-56 bg-white flex flex-col justify-center">
                    <label class="ml-4 inline-block mb-2 text-gray-500">Upload Image</label>
                    <div type="file" class="mx-4 border border-4 border-dashed h-32 bg-white rounded-lg flex justify-center items-center flex-col hover:bg-gray-100 hover:border-gray-300">
                        <input type="file" id="gallery_image" name="gallery_image" class="rounded-lg border-2">
                    </div>
                    <div class="text-center">
                        @error('gallery_image')
                        <p class="text-red-500 text-sm">{{ $errors->first('gallery_image') }}</p>
                        @enderror
                    </div>
                </div>
                <!-- END -->
            </form>

            <!-- Display Paginated Images -->
            {{-- <div class="w-auto mx-auto px-6 py-6 border-2 rounded-lg">
                <div class="flex flex-wrap">
                    @foreach (Auth::getUser()->galleries as $gallery)
                    <div class="h-48 w-auto rounded-lg shadow-xl m-5">
                            <img src="{{ asset('storage/' . $gallery->gallery_image_path) }}" alt="Image" class="w-full h-full object-cover rounded-lg">
                            <p>Note: {{$gallery->note}}</p>
                        <div class="absolute top-0">
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div> --}}
            <div class="w-auto mx-auto px-6 py-6 rounded-lg">
                <div class="flex flex-wrap">
                    @foreach ($documents as $document)
                        <div class="relative h-48 w-auto rounded-lg shadow-xl m-5">
                            {{-- <img src="{{ asset('storage/' . $gallery->gallery_image_path) }}" alt="Image" class="w-full h-full object-cover rounded-lg"> --}}
                            <img src="{{ asset($document->imagePath) }}" alt="Image" class="w-full h-full object-cover rounded-lg">
                            <div class="absolute top-2 right-2">
                                <form method="POST" action="{{ route('dashboard') }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="text-white hover:text-mypink-light">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-4">
{{--                {{$galleries->links()}}--}}
            </div>

            <div class="p-4 flex justify-between">
                <a href="{{ route('dashboard') }}" class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
                    <div class="p-2 text-black text-center">
                        < Back
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
