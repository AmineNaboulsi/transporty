@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 mt-10">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">All Available Navettes</h2>
    <div class="grid grid-cols-1 gap-6">
        @if(count($navettes)==0)
            <div class="bg-white shadow rounded-lg p-8 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">No navettes found</h3>
                <p class="mt-1 text-gray-500">Try changing your search filters or check back later.</p>
            </div>
        @else
            @foreach($navettes as $navette)
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="md:flex">
                    <div class="md:w-1/3 bg-gradient-to-r from-blue-400 to-blue-500 p-6 flex flex-col justify-between">
                        <div>
                            <h3 class="text-2xl font-bold text-white">
                                {{ $navette->cityStart?->name ?? 'N/A' }} - {{ $navette->cityArrive?->name ?? 'N/A' }}
                            </h3>
                            <div class="mt-2 inline-block px-3 py-1 bg-blue-800 bg-opacity-50 rounded-full text-white text-sm">
                                Route #{{ $navette->id }}
                            </div>
                        </div>
                        <div class="mt-4">
                            <span class="text-white text-lg font-semibold">{{ $navette->price }} MAD</span>
                            <p class="text-white text-opacity-80 text-sm">per person</p>
                        </div>
                    </div>

                    <div class="md:w-2/3 p-6">
                        <div class="flex flex-col md:flex-row md:justify-between mb-4">
                            <div class="mb-4 md:mb-0">
                                <h4 class="text-sm text-gray-500 uppercase tracking-wide">Departure</h4>
                                <div class="flex items-center mt-1">
                                    <svg class="h-5 w-5 text-gray-400 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-lg font-medium">{{ $navette->time_start }}</span>
                                </div>
                                <p class="mt-1 text-gray-600">{{ $navette->departureLocation ?? 'Main Terminal' }}</p>
                            </div>

                            <div class="mb-4 md:mb-0">
                                <h4 class="text-sm text-gray-500 uppercase tracking-wide">Arrival</h4>
                                <div class="flex items-center mt-1">
                                    <svg class="h-5 w-5 text-gray-400 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-lg font-medium">{{ $navette->time_end }}</span>
                                </div>
                                <p class="mt-1 text-gray-600">{{ $navette->arrivalLocation ?? 'Main Terminal' }}</p>
                            </div>

                            <div>
                                <h4 class="text-sm text-gray-500 uppercase tracking-wide">Journey</h4>
                                <div class="flex items-center mt-1">
                                    <svg class="h-5 w-5 text-gray-400 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                    </svg>
                                    <span class="text-lg font-medium">{{ $navette->distance ?? '- -' }} km</span>
                                </div>
                                <p class="mt-1 text-gray-600">{{ $navette->duration ?? 'Approx. 2 hrs' }}</p>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 pt-4">
                            <div class="mb-4">
                                <h4 class="text-sm text-gray-500 uppercase tracking-wide mb-2">Description</h4>
                                <p class="text-gray-600">{{ $navette->description ?? 'Comfortable shuttle service with air conditioning, Wi-Fi, and professional drivers. Enjoy a relaxing journey with our modern fleet of vehicles.' }}</p>
                            </div>

                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach ($navette->tags as $tag)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{strtolower($tag->color)}}-100 text-{{strtolower($tag ->color)}}-800">
                                    <svg class="h-3 w-3 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                    </svg>
                                    {{$tag->name}}
                                </span>
                                @endforeach
                            </div>

                            <div class="mt-4 flex flex-col sm:flex-row sm:justify-between sm:items-center">
                                <div class="flex items-center mb-3 sm:mb-0">
                                    <span class="text-gray-600 mr-2">Seats Available:</span>
                                    <span class="font-semibold">{{ $navette->available_seats ?? rand(5, 25) }}</span>
                                </div>
                                <a href="{{route('posts.book', ['id' => $navette->id])}}" class="bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-6 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Book This Navette
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endif

    </div>


</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        fetchCities();
    });

    async function fetchCities() {
        try {
            const res = await fetch(`/api/cities`);
            const data = await res.json();

            if (data) {
                const departureSelect = document.getElementById('departure');
                const destinationSelect = document.getElementById('destination');

                data.forEach((city) => {
                    const option = document.createElement('option');
                    option.text = city.name;
                    option.value = city.id;

                    departureSelect.appendChild(option.cloneNode(true));
                    destinationSelect.appendChild(option);
                });
            }
        } catch (error) {
            console.error("Error fetching cities:", error);
        }
    }
</script>
@endsection
