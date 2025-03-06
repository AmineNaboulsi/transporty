@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-semibold text-gray-800">Reservations Management</h2>
        <a href="{{ route('roles.create') }}"
           class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md transition duration-300 ease-in-out transform hover:scale-105">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Create New Role
        </a>
    </div>
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6 bg-gray-50 border-b border-gray-200">
            <div x-data="{
                searchTerm: '',
                filteredRoles() {
                    return this.roles.filter(role =>
                        role.name.toLowerCase().includes(this.searchTerm.toLowerCase())
                    )
                },

            }">
                <div class="overflow-x-auto">
                    <table class="w-full whitespace-nowrap">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-4 text-left">#</th>
                                <th class="py-3 px-4 text-left">Navette Name</th>
                                <th class="py-3 px-4 text-left">Navette Date</th>
                                <th class="py-3 px-4 text-left">From-To</th>
                                <th class="py-3 px-4 text-left">Permissions</th>
                                <th class="py-3 px-4 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach ($reservations as $reservation)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-4">{{ $reservation['navette']->id }}</td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{ $reservation['navette']->nom }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{ $reservation['navette']->date_navette }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{ $reservation['navette']->city_start .'-'. $reservation['navette']->city_arrive }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex flex-wrap gap-2">
                                       {{$reservation['user']->name ."(". $reservation['user']->email.")"}}
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-center">
                                    @if(strtolower($reservation['status']) == "confirmed")
                                    <div class="flex justify-center items-center gap-2 ">
                                        <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="20px" height="20px"><path fill="#43A047" d="M40.6 12.1L17 35.7 7.4 26.1 4.6 29 17 41.3 43.4 14.9z"/></svg>
                                        <span class="text-[#43A047]">Confirmed</span>
                                    </div>
                                    @elseif(strtolower($reservation['status']) == "pending")
                                    <form action="{{route('booking.confirm',$reservation["id"])}}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <div class="cursor-pointer group flex justify-center items-center gap-2 relative">
                                                <span class="group-hover:opacity-0 transition-opacity duration-300 bg-yellow-100 px-2 py-0.5 rounded-md">Pending</span>
                                                <input type="submit" value="Confirm" class="cursor-pointer absolute opacity-0 group-hover:opacity-100 transition-opacity px-2 py-0.5  bg-green-300 duration-300 text-green-600 rounded-md" />
                                        </div>
                                    </form>
                                    @elseif(strtolower($reservation['status']) == "cancled")
                                        <span class="bg-red-200 px-2 py-0.5 font-medium rounded-md">{{$reservation['status'] }}</span>
                                    @else
                                        <span class="bg-yellow-100">N/A</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-2.5">
                    {{$reservations->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
