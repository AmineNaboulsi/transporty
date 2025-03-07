@extends('layouts.admin')

@section('content')
<h3 class="text-3xl font-medium text-gray-700">Dashboard</h3>

<div class="mt-4">
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <div class="p-4 transition-shadow border-[1px] border-gray-200 rounded-lg shadow-sm hover:shadow-lg bg-white">
            <div class="flex items-start justify-between">
                <div class="flex flex-col space-y-2">
                    <span class="text-gray-400">Total Navettes</span>
                    <span class="text-3xl font-semibold">{{$statistics['totalNavettes']}}</span>
                </div>
                <div class="p-2 rounded-md bg-blue-500 text-white">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
            </div>
            <div class="text-sm text-gray-500">
                <span class="text-green-500">
                    {{$statistics['navetteGrowth']}} %
                </span> from last month
            </div>
        </div>

        <div class="p-4 transition-shadow border-[1px] border-gray-200 rounded-lg shadow-sm hover:shadow-lg bg-white">
            <div class="flex items-start justify-between">
                <div class="flex flex-col space-y-2">
                    <span class="text-gray-400">Total Bookings</span>
                    <span class="text-3xl font-semibold">{{$statistics["totalBookings"]}}</span>
                </div>
                <div class="p-2 rounded-md bg-indigo-500 text-white">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
            </div>
            <div class="text-sm text-gray-500">
                <span class="text-green-500">
                    {{$statistics['bookingGrowth']}} %
                </span> from last month
            </div>
        </div>

        <div class="p-4 transition-shadow border-[1px] border-gray-200 rounded-lg shadow-sm hover:shadow-lg bg-white">
            <div class="flex items-start justify-between">
                <div class="flex flex-col space-y-2">
                    <span class="text-gray-400">Total Revenue</span>
                    <span class="text-3xl font-semibold">{{$statistics['totalRevenue']}} MAD</span>
                </div>
                <div class="p-2 rounded-md  bg-green-500 text-white">

                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="text-sm text-gray-500">
                <span class="text-green-500">
                    {{$statistics['revenueGrowth']}} %
                </span> from last month
            </div>
        </div>

        <div class="p-4 transition-shadow border-[1px] border-gray-200 rounded-lg shadow-sm hover:shadow-lg bg-white">
            <div class="flex items-start justify-between">
                <div class="flex flex-col space-y-2">
                    <span class="text-gray-400">Passengers</span>
                    <span class="text-3xl font-semibold">{{$statistics['totalPassengers']}}</span>
                </div>
                <div class="p-2 rounded-md bg-red-500 text-white">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
            <div class="text-sm text-gray-500">
                <span class="text-green-500">
                    {{$statistics['passengerGrowth']}} %
                </span> from last month
            </div>
        </div>
    </div>
</div>

<div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">
    <div class="bg-white p-6 rounded-lg shadow-sm">
        <h4 class="text-lg font-semibold text-gray-700 mb-4">Bookings Overview</h4>
        <canvas id="bookingsChart" class="w-full h-72"></canvas>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm">
        <h4 class="text-lg font-semibold text-gray-700 mb-4">Popular Routes</h4>
        <canvas id="routesChart" class="w-full h-72"></canvas>
    </div>
</div>

<div class="mt-8">
    <div class="bg-white p-6 rounded-lg shadow-sm">
        <h4 class="text-lg font-semibold text-gray-700 mb-4">Recent Bookings</h4>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Route</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Passengers</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($recentBookings as $booking)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            id
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            name<br>
                            <span class="text-xs">email</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            N/A - N/A
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            cc
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            num_passengers
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            total_price MAD
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Pending
                            </span>
                            {{-- @if($booking?->status == 'confirmed')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Confirmed
                            </span>
                            @elseif($booking?->status == 'pending')

                            @elseif($booking?->status == 'cancelled')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Cancelled
                            </span>
                            @endif --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4 text-right">
            <a href="" class="text-indigo-600 hover:text-indigo-900">View all bookings →</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
