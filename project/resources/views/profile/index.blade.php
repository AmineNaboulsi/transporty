@extends('layouts.profile')

@section('content')


<div class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex overflow-x-auto">
            <a href="{{route('profile.index')}}" class="py-4 px-6 border-b-2 border-indigo-500 font-medium text-indigo-600 whitespace-nowrap">
                My Reservations
            </a>
            <a  href="{{route('profile.favorite')}}" class="py-4 px-6 border-b-2 border-transparent font-medium text-gray-600 hover:text-gray-900 hover:border-gray-300 whitespace-nowrap">
                Favorite Routes
            </a>
            <a  href="{{route('profile.payment')}}" class="py-4 px-6 border-b-2 border-transparent font-medium text-gray-600 hover:text-gray-900 hover:border-gray-300 whitespace-nowrap">
                Payment History
            </a>
            <a  href="{{route('profile.notification')}}" class="py-4 px-6 border-b-2 border-transparent font-medium text-gray-600 hover:text-gray-900 hover:border-gray-300 whitespace-nowrap">
                Notifications
            </a>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">My Reservations</h2>
        <div class="flex">
            <div class="relative mr-2">
                <select id="status-filter" class="appearance-none block w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="all">All Statuses</option>
                    <option value="upcoming">Upcoming</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>
            <div class="relative">
                <select id="date-filter" class="appearance-none block w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="all">All Dates</option>
                    <option value="upcoming">Next 30 days</option>
                    <option value="past">Past 30 days</option>
                    <option value="past90">Past 90 days</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-8">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Upcoming Reservations</h3>
        @if($upcomingReservations->hasPages())
            <div class="mt-4 mb-4">
            {{ $upcomingReservations->links() }}
            </div>
        @endif
        @forelse($upcomingReservations ?? [] as $reservation)
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden mb-4">
            <div class="p-4 sm:p-6">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start">
                    <div class="mb-4 sm:mb-0">
                        @if($reservation->status == 'Confirmed')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Confirmed
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                Pending
                            </span>
                        @endif

                        <h4 class="text-lg font-semibold text-gray-900 mt-2">{{ $reservation->start_city ?? 'N/A' }} to {{ $reservation->end_city ?? 'N/A' }}</h4>
                        <p class="text-sm text-gray-500">Reservation #{{ $reservation->id  }}</p>
                    </div>
                    <div class="flex flex-col items-start sm:items-end">
                        <p class="text-sm text-gray-500">Reserved on {{ $reservation->created_at ? $reservation->created_at  : 'N/A' }}</p>
                        <p class="text-lg font-semibold text-indigo-600 mt-1">{{ $reservation->price ?? 'N/A' }} MAD</p>
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h5 class="text-sm font-medium text-gray-900">Departure Date</h5>
                            <p class="text-sm text-gray-500">{{ $reservation->date_navette ?? 'N/A' }}</p>
                            <p class="text-sm font-medium text-gray-900 mt-1">{{ $reservation->time_start ?? 'N/A' }} - {{ $reservation->time_end ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h5 class="text-sm font-medium text-gray-900">Pickup Location</h5>
                            <p class="text-sm text-gray-500">{{ $reservation->start_city_region ?? 'Main Terminal, Station 3' }}</p>
                            <p class="text-sm text-gray-500 mt-1">{{ $reservation->start_city ?? 'Casablanca' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h5 class="text-sm font-medium text-gray-900">Passenger(s)</h5>
                            <p class="text-sm text-gray-500">1 passenger(s)</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex flex-col sm:flex-row justify-between items-center border-t border-gray-200 pt-4">
                    <div class="mb-3 sm:mb-0">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 bg-indigo-600 rounded-full flex items-center justify-center">
                                <span class="text-white font-medium">{{ $reservation->vehicle_type[0] ?? 'V' }}</span>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">{{ $reservation->type_vehicule ?? 'N/A' }}</p>
                                <p class="text-sm text-gray-500">Campany</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex space-x-3">
                        <a href="" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            View Details
                        </a>
                        @if($reservation->status == 'Pending')
                            <a href="" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Cancel
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white border border-gray-200 rounded-lg p-6 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No upcoming reservations</h3>
            <p class="mt-1 text-sm text-gray-500">Get started by booking a new navette service.</p>
            <div class="mt-6">
                <a href="" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Browse Navettes
                </a>
            </div>
        </div>
        @endforelse
    </div>

</div>

<div class="bg-gray-50 border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h3>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <a href="" class="bg-white shadow rounded-lg p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                        <svg class="h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-base font-medium text-gray-900">Book New Trip</h4>
                        <p class="text-sm text-gray-500">Find and book your next journey</p>
                    </div>
                </div>
            </a>

            <a href="" class="bg-white shadow rounded-lg p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                        <svg class="h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-base font-medium text-gray-900">Manage Payments</h4>
                        <p class="text-sm text-gray-500">View and update payment methods</p>
                    </div>
                </div>
            </a>

            <a href="" class="bg-white shadow rounded-lg p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                        <svg class="h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-base font-medium text-gray-900">Help Center</h4>
                        <p class="text-sm text-gray-500">Get support and answers</p>
                    </div>
                </div>
            </a>

            <a href="" class="bg-white shadow rounded-lg p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                        <svg class="h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-base font-medium text-gray-900">Account Settings</h4>
                        <p class="text-sm text-gray-500">Update your preferences</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>


@endsection
