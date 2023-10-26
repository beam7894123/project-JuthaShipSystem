@extends('layouts.main')

@section('content')

@include('alert')

    <div class="mt-4 w-full">
        <h1 class="text-2xl font-medium text-center text-white">Documents</h1>
        <div class="border-b border-gray-400 mt-4"></div>
        <div class="mx-6 my-4 flex flex-col">
            <!-- INSERT HERE!!! -->
            @if(Auth::user()->role === 'CAPTAIN')
            <form method="POST" action="{{route('documents.store' , ['journey' => $journey ])}}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <!-- Upload Files Form -->
                <div class="w-auto h-56 bg-white flex flex-col justify-center">
                    <label class="ml-4 inline-block mb-2 text-gray-500">Upload Image</label>
                    <div type="file" class="mx-4 border border-4 border-dashed h-32 bg-white rounded-lg flex justify-center items-center flex-col hover:bg-gray-100 hover:border-gray-300">
                        <input type="file" id="image" name="image" class="rounded-lg border-2">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="bg-blue-800 hover:bg-blue-500 text-white font-bold py-2 px-6 h-12 rounded-xl">
                            Upload
                        </button>
                        @error('gallery_image')
                        <p class="text-red-500 text-sm">{{ $errors->first('gallery_image') }}</p>
                        @enderror
                    </div>
                </div>
                <!-- END -->
            </form>
            @endif

            <div class="w-auto mx-auto px-6 py-6 rounded-lg">
                <div class="flex flex-wrap">
                    @foreach ($documents as $document)
                        <div class="relative h-48 w-auto rounded-lg shadow-xl m-5">
                            <img src="{{ asset('storage/'. $document->imagePath) }}" alt="Image" class="w-full h-full object-cover rounded-lg">
                            <div class="absolute top-2 right-2">
                                @if(Auth::user->role === 'CAPTAIN')
                                <form method="POST" action="{{ route('documents.destroy', ['document' => $document]) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="text-white hover:text-mypink-light">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                        </svg>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
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
