@extends('layouts.admin')

@section('content')

<div class="container px-6 py-8 mx-auto">
    <div class="grid grid-cols-1">
        <div class="bg-white shadow-md rounded-lg">
            <div class="bg-white p-6 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4m-4-8a3 3 0 01-3 3h-2a3 3 0 01-3-3m6 0v-3a3 3 0 00-6 0v3m6 0H7" />
                    </svg>
                    Create New Role
                </h2>
                <a href="{{ route('roles.index') }}" class="text-gray-600 hover:text-gray-800 transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                    </svg>
                </a>
            </div>

            <form
                action="{{ route('roles.store') }}"
                method="POST"
                class="p-6"
                x-data="roleFormHandler()"
            >
                @csrf
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="role_name">
                            Role Name
                        </label>
                        <input
                            type="text"
                            name="name"
                            id="role_name"
                            required
                            placeholder="Enter role name (e.g., Admin, Manager)"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            x-model="roleName"
                        >
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <div class="bg-gray-50 border border-gray-200 rounded-md p-6">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-lg font-semibold text-gray-800">
                                    Select Permissions
                                </h3>
                                {{-- <div class="flex items-center">
                                    <input
                                        type="checkbox"
                                        id="select-all"
                                        class="form-checkbox h-4 w-4 text-indigo-600 mr-2"
                                        x-model="selectAll"
                                    >
                                    <label for="select-all" class="text-sm text-gray-700">
                                        Select All
                                    </label>
                                </div> --}}
                            </div>

                            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($permissionGroups as $group => $permissions)
                                    <div class="bg-white shadow-sm rounded-md p-4">
                                        <h4 class="font-medium text-gray-700 mb-3 border-b pb-2">
                                            {{ ucfirst($group) }} Permissions
                                        </h4>

                                        <div class="space-y-2">
                                            @foreach($permissions as $permission)
                                                <div class="flex items-center">
                                                    <input
                                                        type="checkbox"
                                                        name="permissions[]"
                                                        value="{{ $permission->id }}"
                                                        id="permission_{{ $permission->id }}"
                                                        class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"
                                                        x-model="selectedPermissions"
                                                    >
                                                    <label
                                                        for="permission_{{ $permission->id }}"
                                                        class="ml-2 text-sm text-gray-700"
                                                    >
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-4">
                        <a  
                            href="{{ route('roles.index') }}"
                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition duration-300"
                        >
                            Cancel
                        </a>
                        <button
                            type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition duration-300 flex items-center"
                            :disabled="!roleName"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                            </svg>
                            Create Role
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function roleFormHandler() {
        return {
            roleName: '',
            selectedPermissions: [],
            selectAll: false,

            toggleAllPermissions() {
                const permissionCheckboxes = document.querySelectorAll('input[name="permissions[]"]');

                permissionCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.selectAll;
                });

                this.selectedPermissions = this.selectAll
                    ? Array.from(permissionCheckboxes).map(cb => cb.value)
                    : [];
            }
        }
    }
</script>
@endpush
@endsection
