@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h4 class="text-lg font-medium text-gray-900">Add New Navette</h4>
        </div>
        <div class="px-4 py-5 sm:p-6">
            <form action="{{route('navettes.update',$navettes->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                        <input type="text" value="{{$navettes->nom}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('nom') border-red-500 @enderror" id="nom" name="nom" required>
                        @error('nom')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                        <input type="number" value="{{$navettes->price}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('price') border-red-500 @enderror" id="price" name="price" step="0.01" required>
                        @error('price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="date_navette" class="block text-sm font-medium text-gray-700">Date Navette</label>
                        <input type="date" value="{{$navettes->date_navette}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('date_navette') border-red-500 @enderror" id="date_navette" name="date_navette" required>
                        @error('date_navette')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="type_vehicule" class="block text-sm font-medium text-gray-700">Type Vehicule</label>
                        <input type="text" value="{{$navettes->type_vehicule}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('type_vehicule') border-red-500 @enderror" id="type_vehicule" name="type_vehicule" required>
                        @error('type_vehicule')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="places_disponible" class="block text-sm font-medium text-gray-700">Places Disponible</label>
                        <input type="number" value="{{$navettes->places_disponible}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('places_disponible') border-red-500 @enderror" id="places_disponible" name="places_disponible" required>
                        @error('places_disponible')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="city_start" class="block text-sm font-medium text-gray-700">City Start</label>
                        <select class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('city_start') border-red-500 @enderror" id="city_start" name="city_start" required>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ $navettes->city_start == $city->id ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('city_start')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="city_arrive" class="block text-sm font-medium text-gray-700">City Arrive</label>
                        <select class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('city_arrive') border-red-500 @enderror" id="city_arrive" name="city_arrive" required>
                            @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ $navettes->city_arrive == $city->id ? 'selected' : '' }}>
                                {{ $city->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('city_arrive')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="time_start" class="block text-sm font-medium text-gray-700">Time Start</label>
                        <input type="time" value="{{$navettes->time_start}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('time_start') border-red-500 @enderror" id="time_start" name="time_start" required>
                        @error('time_start')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="time_end" class="block text-sm font-medium text-gray-700">Time End</label>
                        <input type="time" value="{{$navettes->time_end}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('time_end') border-red-500 @enderror" id="time_end" name="time_end" required>
                        @error('time_end')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
                    <select class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('tags') border-red-500 @enderror" id="tags" name="tags[]" multiple>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}" {{ in_array($tag->id, $navettes->tags->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('tags')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('description') border-red-500 @enderror" id="description" name="description" rows="3" required>{{$navettes->description}}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6 flex items-center space-x-4">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Save Changes
                    </button>
                    <a href="" onclick="event.preventDefault(); window.history.back();" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#tags').select2({
            placeholder: 'Select tags',
            allowClear: true
        });
    });
</script>
@endpush
