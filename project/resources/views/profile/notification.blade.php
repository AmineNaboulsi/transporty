@extends('layouts.profile')

@section('content')

<div class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex overflow-x-auto">
            <a href="{{route('profile.index')}}"  class="py-4 px-6 border-b-2 border-transparent font-medium text-gray-600 hover:text-gray-900 hover:border-gray-300 whitespace-nowrap" >
                My Reservations
            </a>
            <a  href="{{route('profile.favorite')}}"  class="py-4 px-6 border-b-2 border-transparent font-medium text-gray-600 hover:text-gray-900 hover:border-gray-300 whitespace-nowrap">
                Favorite Routes
            </a>
            <a  href="{{route('profile.payment')}}"  class="py-4 px-6 border-b-2 border-indigo-500 font-medium text-indigo-600 whitespace-nowrap">
                Payment History
            </a>
            <a  href="{{route('profile.notification')}}" class="py-4 px-6 border-b-2 border-transparent font-medium text-gray-600 hover:text-gray-900 hover:border-gray-300 whitespace-nowrap">
                Notifications
            </a>
        </div>
    </div>
</div>

<div class="">
    Notifications
</div>

@endsection
