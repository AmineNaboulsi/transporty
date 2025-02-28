
@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-r from-blue-500 to-indigo-600">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight">
                Your Reliable Transport Solution
            </h1>
            <p class="mt-3 max-w-md mx-auto text-base text-white sm:text-lg md:mt-5 md:text-xl">
                Book shuttle services and navettes to your favorite destinations with ease and comfort.
            </p>
            <div class="mt-8 flex justify-center">
                <div class="rounded-md shadow">
                    <a href="#" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10">
                        Find Routes
                    </a>
                </div>
                <div class="ml-3 rounded-md shadow">
                    <a href="#" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-800 hover:bg-indigo-900 md:py-4 md:text-lg md:px-10">
                        Make Reservation
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Find Your Route</h2>
        <form action="{{route('posts.index')}}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="departure" class="block text-sm font-medium text-gray-700">Departure</label>
                <select name="departure" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    @foreach ($cities as $city)
                        <option value="{{$city->id}}">{{$city->name}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="destination" class="block text-sm font-medium text-gray-700">Destination</label>
                <select id="" name="destination" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    @foreach ($cities as $city)
                        <option value="{{$city->id}}">{{$city->name}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                <input type="date" name="date" id="date" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Search
                </button>
            </div>
        </form>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Popular Routes</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($navettes as $navette)
        <div class=" bg-white shadow rounded-lg overflow-hidden">
            <div class="h-40 bg-gradient-to-r from-blue-400 to-blue-500 flex items-center justify-center">
            <h3 class="text-xl font-semibold text-white">
                {{ $navette->cityStart?->name ?? 'N/A' }} - {{ $navette->cityArrive?->name ?? 'N/A' }}
            </div>
            <div class="p-4">
            <div class="flex justify-between mb-2">
                <span class="text-gray-600">Departure:</span>
                <span class="font-medium">{{ $navette->time_start }}</span>
                <span class="font-medium">{{ $navette->time_end }}</span>
            </div>
            <div class="flex justify-between mb-4">
                <span class="text-gray-600">Price:</span>
                <span class="font-medium text-green-600">{{ $navette->price }} MAD</span>
            </div>
            <button class="w-full bg-indigo-400 border border-transparent rounded-md py-2 px-4 flex items-center justify-center text-sm font-medium text-white hover:bg-indigo-200 focus:outline-none">
                Book Now
            </button>
            </div>
        </div>
        @endforeach

    </div>
</div>

<div class="bg-gray-100 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900">Why Choose Our Service</h2>
            <p class="mt-4 text-lg text-gray-600">The best transportation platform for all your travel needs</p>
        </div>

        <div class="mt-10">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white mb-4">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Reliable & Punctual</h3>
                    <p class="mt-2 text-gray-600">We value your time. Our services run on schedule, ensuring you reach your destination without delays.</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white mb-4">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Affordable Prices</h3>
                    <p class="mt-2 text-gray-600">Enjoy comfortable transportation at competitive prices with no hidden fees.</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white mb-4">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Comfort & Safety</h3>
                    <p class="mt-2 text-gray-600">Our vehicles are regularly maintained and equipped with safety features for a comfortable journey.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-8">Frequently Asked Questions</h2>

    <div class="space-y-4">
        <div class="bg-white shadow rounded-lg p-4">
            <button class="flex justify-between w-full items-center focus:outline-none">
                <h3 class="text-lg font-medium text-gray-900">How do I make a reservation?</h3>
                <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </button>
            <div class="mt-2 text-gray-600">
                <p>You can make a reservation by searching for your route, selecting the departure time, and completing your booking details. Payment can be made online or in person.</p>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-4">
            <button class="flex justify-between w-full items-center focus:outline-none">
                <h3 class="text-lg font-medium text-gray-900">Can I cancel my reservation?</h3>
                <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </button>
            <div class="mt-2 text-gray-600">
                <p>Yes, you can cancel your reservation up to 24 hours before departure for a full refund. Cancellations within 24 hours may be subject to a fee.</p>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-4">
            <button class="flex justify-between w-full items-center focus:outline-none">
                <h3 class="text-lg font-medium text-gray-900">How much luggage can I bring?</h3>
                <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </button>
            <div class="mt-2 text-gray-600">
                <p>Each passenger is allowed one large bag (up to 20kg) and one small hand luggage. Additional luggage may incur extra fees.</p>
            </div>
        </div>
    </div>
</div>

<div class="bg-indigo-700">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
        <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
            <span class="block">Ready to travel?</span>
            <span class="block text-indigo-200">Book your shuttle service today.</span>
        </h2>
        <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
            <div class="inline-flex rounded-md shadow">
                <a href="#" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-indigo-50">
                    Find Routes
                </a>
            </div>
            <div class="ml-3 inline-flex rounded-md shadow">
                <a href="#" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                    Register Now
                </a>
            </div>
        </div>
    </div>
</div>
<script>
    // document.addEventListener('DOMContentLoaded', () => {
    //     fetchCities();
    // });
    // async function fetchCities() {
    //     const res = await fetch(`http://localhost:8000/getcitys`);
    //     const data = await res.json();
    //     if (data) {
    //         data.forEach((city) => {
    //             const option = document.createElement('option');
    //             option.text = city.name;
    //             option.value = city.id;
    //             document.getElementById('destination').appendChild(option.cloneNode(true));
    //             document.getElementById('departure').appendChild(option);
    //         });
    //     }
    // }
</script>

@endsection
