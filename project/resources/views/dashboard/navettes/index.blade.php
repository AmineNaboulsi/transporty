@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center">
    <h2 class="text-2xl font-semibold text-gray-800">Navettes Management</h2>
    @if(Auth::user()->role->name != "admin")
    <a href="{{ route('navettes.create') }}"
       class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md transition duration-300 ease-in-out transform hover:scale-105">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        Create Navette
    </a>
    @endif

</div>
<div class="overflow-x-auto mt-4">
    <table class="w-full whitespace-nowrap">
        <thead>
            <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-4 text-left">#</th>
                <th class="py-3 px-4 text-left">Route</th>
                <th class="py-3 px-4 text-left">Date</th>
                <th class="py-3 px-4 text-left">Vehicule</th>
                <th class="py-3 px-4 text-left">Places</th>
                <th class="py-3 px-4 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @foreach($navettes as $index  => $navette)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-4">{{ $index + 1 }}</td>
                <td class="py-3 px-4">
                    <div class="flex items-center">
                        <span class="font-medium">{{ $navette->cityStart->name.' - '. $navette->cityArrive->name }}</span>
                    </div>
                </td>
                <td class="py-3 px-4">
                    <div class="flex flex-wrap gap-2">
                    {{ $navette->date_navette }}
                    </div>
                </td>
                <td class="py-3 px-4">
                    <div class="flex flex-wrap gap-2">
                    {{ $navette->type_vehicule }}
                    </div>
                </td>
                <td class="py-3 px-4">
                    <div class="flex flex-wrap gap-2">
                    {{ $navette->places_disponible }}
                    </div>
                </td>
                <td class="py-3 px-4 text-center">
                    @if(Auth::user()->role->name !== "admin")
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('navettes.edit', $navette->id) }}"
                            class="text-blue-500 hover:text-blue-700 transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                            </a>
                            <form action="{{ route('navettes.destroy', $navette->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this navette ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-500 hover:text-red-700 transition duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('navettes.edit', $navette->id) }}"
                            class="text-gray-500 hover:text-gray-700 transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                </svg>
                            </a>
                        </div>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3.5">
        {{$navettes->links()}}
    </div>
</div>

@endsection
