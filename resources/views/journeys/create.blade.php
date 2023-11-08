@extends('layouts.main')

@section('content')
@include('alert')
<form action="{{ route('journeys.store') }}" method="post" class="mt-6 space-y-6" enctype="multipart/form-data">
    @csrf
    <div class="flex justify-center items-center">
        <div class="w-1/2">
            <div id="ship_list" class="bg-white rounded-md max-w-full mx-auto mt-8 overflow-y-auto">
                <div class="bg-[#011147] py-2 px-4">
                    <h2 class="text-xl font-semibold text-white">Create Journey details</h2>
                </div>

                <div class="p-4">
                    <div class="grid grid-cols-2 items-center p-6 text-3xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4 text-black">
                        <label for="start_date" class="text-xl font-medium text-gray-900 block mb-2">Start Date</label>
                        <input id="start_date" type="datetime-local" name="start_date" value="<?php echo date('Y-m-d\TH:i'); ?>" />
                    </div>

                    <div class="grid grid-cols-2 items-center p-6 text-3xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4 text-black">
                        <label for="start_date" class="text-xl font-medium text-gray-900 block mb-2">Arrive Date</label>
                        <input id="arrive_date" type="datetime-local" name="arrive_date" />
                    </div>

                    <div class="grid grid-cols-2 items-center p-6 text-3xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4 text-black">
                        <label for="destination" class="text-xl font-medium text-gray-900 block mb-2">Destination:</label>
                        <select id="destination" class="form-control" name="destination" required="required">
                            <option value="Port of Los Angeles, USA">Port of Los Angeles, USA</option>
                            <option value="Port of Long Beach, USA">Port of Long Beach, USA</option>
                            <option value="Port of New York and New Jersey, USA">Port of New York and New Jersey, USA</option>
                            <option value="Port of Savannah, USA">Port of Savannah, USA</option>
                            <option value="Port of Seattle and Tacoma, USA">Port of Seattle and Tacoma, USA</option>
                            <option value="Port of Oakland, USA">Port of Oakland, USA</option>
                            <option value="Port of Houston, USA">Port of Houston, USA</option>
                            <option value="Port of Norfolk, USA">Port of Norfolk, USA</option>
                            <option value="Port of Charleston, USA">Port of Charleston, USA</option>
                            <option value="Port of Miami, USA">Port of Miami, USA</option>
                            <option value="Port of Jacksonville, USA">Port of Jacksonville, USA</option>
                            <option value="Port of Tacoma, USA">Port of Tacoma, USA</option>
                            <option value="Port of Baltimore, USA">Port of Baltimore, USA</option>
                            <option value="Port of Philadelphia, USA">Port of Philadelphia, USA</option>
                            <option value="Port of Rotterdam, Netherlands">Port of Rotterdam, Netherlands</option>
                            <option value="Port of Antwerp, Belgium">Port of Antwerp, Belgium</option>
                            <option value="Port of Hamburg, Germany">Port of Hamburg, Germany</option>
                            <option value="Port of Bremerhaven, Germany">Port of Bremerhaven, Germany</option>
                            <option value="Port of Algeciras, Spain">Port of Algeciras, Spain</option>
                            <option value="Port of Singapore, Singapore">Port of Singapore, Singapore</option>
                            <option value="Port of Shanghai, China">Port of Shanghai, China</option>
                            <option value="Port of Ningbo-Zhoushan, China">Port of Ningbo-Zhoushan, China</option>
                            <option value="Port of Shenzhen, China">Port of Shenzhen, China</option>
                            <option value="Port of Guangzhou Harbor, China">Port of Guangzhou Harbor, China</option>
                            <option value="Port of Busan, South Korea">Port of Busan, South Korea</option>
                            <option value="Port of Hong Kong, China">Port of Hong Kong, China</option>
                            <option value="Port of Qingdao, China">Port of Qingdao, China</option>
                            <option value="Port of Tianjin, China">Port of Tianjin, China</option>
                            <option value="Port of Kaohsiung, Taiwan">Port of Kaohsiung, Taiwan</option>
                            <option value="Port of Xiamen, China">Port of Xiamen, China</option>
                            <option value="Port of Rotterdam, Netherlands">Port of Rotterdam, Netherlands</option>
                            <option value="Port of Antwerp, Belgium">Port of Antwerp, Belgium</option>
                            <option value="Port of Hamburg, Germany">Port of Hamburg, Germany</option>
                            <option value="Port of Tokyo, Japan">Port of Tokyo, Japan</option>
                            <option value="Port of Kobe, Japan">Port of Kobe, Japan</option>
                            <option value="Port of Yokohama, Japan">Port of Yokohama, Japan</option>
                            <option value="Port of Nagoya, Japan">Port of Nagoya, Japan</option>
                            <option value="Port of Tanjung Pelepas, Malaysia">Port of Tanjung Pelepas, Malaysia</option>
                            <option value="Port of Laem Chabang, Thailand">Port of Laem Chabang, Thailand</option>
                            <option value="Port of Colombo, Sri Lanka">Port of Colombo, Sri Lanka</option>
                            <option value="Port of Chennai, India">Port of Chennai, India</option>
                            <option value="Port of Jawaharlal Nehru, India">Port of Jawaharlal Nehru, India</option>
                            <option value="Port of Mumbai, India">Port of Mumbai, India</option>
                            <option value="Port of Salalah, Oman">Port of Salalah, Oman</option>
                            <option value="Port of Khor Fakkan, UAE">Port of Khor Fakkan, UAE</option>
                            <option value="Port of Jebel Ali, UAE">Port of Jebel Ali, UAE</option>
                            <option value="Port of Jeddah, Saudi Arabia">Port of Jeddah, Saudi Arabia</option>
                        </select>
                    </div>
                </div>
            </div>

        </div>
        <div class="w-1/2 p-4">
            <img src="{{ asset('images/JUTHA_MALEE_SHIP.png') }}" alt="JUTHA_MALEE_SHIP IMG" class="rounded-md shadow-lg hover:shadow-xl transition duration-300">
        </div>
    </div>

    <div class="p-4 flex justify-between">
        <a href="{{ route('journeys.index') }}" class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
            <div class="p-2 text-black text-center">
                < Back
            </div>
        </a>
        <button type="submit" class="block p-2 text-xl bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-[#c0cfff] transition duration-300 m-4">
            Save >
        </button>
    </div>
    </div>
</form>
@endsection
