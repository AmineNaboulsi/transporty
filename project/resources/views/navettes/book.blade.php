@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 mt-10">
    <div class="mb-6 flex items-center">
        <a href="{{route('posts.index')}}" class="text-blue-600 hover:text-blue-800 flex items-center">
            <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back to all navettes
        </a>
    </div>

    <h2 class="text-2xl font-bold text-gray-900 mb-6">Confirm Your Booking</h2>

    <div class="bg-white shadow rounded-lg overflow-hidden mb-8">
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

                <div class="flex flex-wrap gap-2 mb-4">
                    @if($navette->hasWifi ?? true)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <svg class="h-3 w-3 mr-1" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                        Wi-Fi
                    </span>
                    @endif

                    @if($navette->hasAC ?? true)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <svg class="h-3 w-3 mr-1" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                        Air Conditioning
                    </span>
                    @endif

                    @if($navette->hasPower ?? true)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <svg class="h-3 w-3 mr-1" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                        Power Outlets
                    </span>
                    @endif

                    @if($navette->hasWater ?? false)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <svg class="h-3 w-3 mr-1" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                        Complimentary Water
                    </span>
                    @endif
                </div>

                <div class="mt-4 flex items-center">
                    <span class="text-gray-600 mr-2">Seats Available:</span>
                    <span class="font-semibold">{{ $navette->available_seats ?? rand(5, 25) }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Complete Your Booking</h3>

            <form action="{{route('booking.reservation', ['id' => $navette->id])}}" method="POST">
                @csrf

                <div class="mt-6 bg-gray-50 p-4 rounded-md">
                    <div class="flex items-center mb-3">
                        <h4 class="text-base font-medium text-gray-900">Price Summary</h4>
                    </div>
                    <div class="flex justify-between mb-2">
                        <p class="text-sm text-gray-500">1 passenger × {{ $navette->price }} MAD</p>
                        <p class="text-sm font-medium text-gray-900">{{ $navette->price }} MAD</p>
                    </div>
                    <div class="pt-2 border-t border-gray-200">
                        <div class="flex justify-between">
                            <p class="text-base font-medium text-gray-900">Total</p>
                            <p class="text-base font-medium text-gray-900" id="total-price">{{ $navette->price }} MAD</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="w-full bg-indigo-600 border border-transparent rounded-md shadow-sm py-3 px-4 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Confirm Booking
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

@if(session()->has('success') || session()->has('error'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(session()->has('success'))
            showNotification('{{ session('success') }}', 'success');
        @endif

        @if(session()->has('error'))
            showNotification('{{ session('error') }}', 'error');
        @endif
    });

    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = 'fixed left-5 top-20 right-5 z-50 flex justify-center items-center';

        const content = document.createElement('div');
        content.className = type === 'success'
            ? 'min-w-[250px] max-w-xs p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 shadow-lg'
            : 'min-w-[250px] max-w-xs p-4 text-sm text-red-800 rounded-lg bg-red-50 shadow-lg';

        content.innerHTML = `<span class="font-medium">${type === 'success' ? 'Success!' : 'Error!'}</span> ${message}`;

        notification.appendChild(content);
        document.body.appendChild(notification);

        setTimeout(() => {
            notification.remove();
        }, 5000);
    }
</script>
@endif

@endsection
