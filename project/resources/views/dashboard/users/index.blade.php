@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center">
    <h2 class="text-2xl font-semibold text-gray-800">users Users Roles</h2>
</div>
<div class="overflow-x-auto mt-4">
    <table class="w-full whitespace-nowrap">
        <thead>
            <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-4 text-left">#</th>
                <th class="py-3 px-4 text-left">Name</th>
                <th class="py-3 px-4 text-left">Email</th>
                <th class="py-3 px-4 text-left">Role</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @foreach($users as $index  => $user)
            <tr class="border-b border-gray-200 hover:bg-gray-100" id="user-row-{{$user->id}}">
                <td class="py-3 px-4">{{ $index + 1 }}</td>
                <td class="py-3 px-4">
                    <div class="flex items-center">
                        <span class="font-medium">{{  $user->name}}</span>
                    </div>
                </td>
                <td class="py-3 px-4">
                    <div class="flex items-center">
                        <span class="font-medium">{{  $user->email}}</span>
                    </div>
                </td>
                <td class="py-3 px-4 relative">
                    @if(Auth::user()->id == $user->id)
                    <span class="bg-green-100 text-green-800 py-1 px-2 rounded-full text-xs">
                        you are <span class="font-semibold">{{ $user->role->name }}
                        </span>
                    </span>
                    @else
                        <select onchange="showSaveButton('{{$user->id}}')" id="role-select-{{$user->id}}">
                            @foreach($roles as $role)
                                <option
                                value="{{$role->id}}"
                                {{ $user->role_id == $role->id ? 'selected' : '' }}
                                >{{$role->name}}</option>
                            @endforeach
                        </select>
                        <div class="absolute top-0 right-0 ">
                                <button
                                id="save-button-{{$user->id}}"
                                onclick="saveChanges('{{$user->id}}')"
                                class="hidden mt-2 text-green-800 bg-green-100 hover:bg-green-300 border-[1px] border-green-600  font-semibold text-xs py-1 px-4 rounded">
                                Save Changes
                                </button>
                        </div>
                    @endif

                </td>
            </tr>


            @endforeach
        </tbody>
    </table>

</div>
<script>
    function showSaveButton(userId) {
        document.getElementById(`save-button-${userId}`).classList.remove('hidden');
    }
    async function saveChanges(userId) {
        const roleId = document.getElementById(`role-select-${userId}`).value;
        const res = await fetch(`/dashboard/users/assign-role`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                role_id: roleId ,
                user_id: userId
            })
        });
        const response = await res.json();
        if (response.status === 'success') {
            document.getElementById(`user-row-${userId}`).classList.add('bg-green-100');
            setTimeout(() => {
                document.getElementById(`user-row-${userId}`).classList.remove('bg-green-100');
            }, 3000);
        }
        document.getElementById(`save-button-${userId}`).classList.add('hidden');
        location.reload();
    }
</script>
@endsection
