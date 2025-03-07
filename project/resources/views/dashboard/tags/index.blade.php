@extends('layouts.admin')

@section('content')
<div x-data="{
    showSidebar: false,
    isEditing: false,
    currentTag: null,
    colors: [
        { name: 'Red', value: 'red', bg: 'bg-red-100', text: 'text-red-800', border: 'border-red-200' },
        { name: 'Green', value: 'green', bg: 'bg-green-100', text: 'text-green-800', border: 'border-green-200' },
        { name: 'Blue', value: 'blue', bg: 'bg-blue-100', text: 'text-blue-800', border: 'border-blue-200' },
        { name: 'Yellow', value: 'yellow', bg: 'bg-yellow-100', text: 'text-yellow-800', border: 'border-yellow-200' },
        { name: 'Purple', value: 'purple', bg: 'bg-purple-100', text: 'text-purple-800', border: 'border-purple-200' },
        { name: 'Gray', value: 'gray', bg: 'bg-gray-100', text: 'text-gray-800', border: 'border-gray-200' }
    ],
    newTag: { name: '', color: 'blue' },
    openSidebar(tag = null) {
        this.showSidebar = true;
        if (tag) {
            this.isEditing = true;
            this.currentTag = tag;
            this.newTag = { ...tag };
        } else {
            this.isEditing = false;
            this.currentTag = null;
            this.newTag = { name: '', color: 'blue' };
        }
    },
    closeSidebar() {
        this.showSidebar = false;
    },
    saveTag() {
        if (this.newTag.name.trim() === '') return;

        if (this.isEditing) {
            // Update existing tag
            const index = this.tags.findIndex(t => t.id === this.currentTag.id);
            if (index !== -1) {
                this.tags[index] = { ...this.tags[index], ...this.newTag };
            }
        } else {
            // Add new tag
            const newId = Math.max(...this.tags.map(t => t.id), 0) + 1;
            this.tags.push({ id: newId, ...this.newTag, count: 0 });
        }

        this.closeSidebar();
        // In real implementation, you would make an AJAX call to save to the database
    },
    deleteTag(id) {
        if (confirm('Are you sure you want to delete this tag?')) {
            this.tags = this.tags.filter(t => t.id !== id);
            // In real implementation, you would make an AJAX call to delete from the database
        }
    },
    getColorClass(color, type) {
        const found = this.colors.find(c => c.value === color);
        return found ? found[type] : '';
    }
}">
    <!-- Page header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Navette Tags</h2>
                <p class="mt-1 text-sm text-gray-600">Manage tags to categorize your navettes</p>
            </div>
            <button
                @click="openSidebar()"
                class="px-4 py-2 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
            >
                <i class="fas fa-plus mr-2"></i> Add New Tag
            </button>
        </div>
    </div>

    <!-- Content area -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <!-- Stats summary -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-6 border-b border-gray-200">
            <div class="p-4 bg-blue-50 rounded-lg">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-500 text-white mr-4">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-blue-600">Total Tags</p>
                        <p class="text-2xl font-semibold text-gray-800" >{{$tagsCount}}</p>
                    </div>
                </div>
            </div>

            <div class="p-4 bg-green-50 rounded-lg">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-500 text-white mr-4">
                        <i class="fas fa-bus"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-green-600">Tagged Navettes</p>
                        <p class="text-2xl font-semibold text-gray-800" >
                            {{ $tags->sum('navettes_count') }}
                        </p>
                    </div>
                </div>
            </div>


        </div>



        <!-- Tags list -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tag Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Color
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Navettes
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($tags as $tag)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900" >{{$tag->name}}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="inline-flex text-{{strtolower($tag->color)}}-800 border-[1px] border-{{strtolower($tag->color)}}-300 bg-{{strtolower($tag->color)}}-200 items-center px-2.5 py-0.5 rounded-full text-xs font-medium"


                            >{{$tag->color}}</span>
                           </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500" >{{$tag->navettes_count}} navettes</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <form action="{{route('tags.destroy',$tag->id)}}" method="POST">
                                @csrf
                                @method('POST')
                                <button type="submit" class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
           {{$tags->links()}}
        </div>
    </div>

    <!-- Slide-in sidebar for adding/editing tags -->
    <div
        x-cloak
        x-show="showSidebar"
        class="fixed inset-0 overflow-hidden z-50"
        x-transition:enter="transition ease-in-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div class="absolute inset-0 overflow-hidden">
            <!-- Background overlay -->
            <div
                x-show="showSidebar"
                @click="closeSidebar"
                class="absolute inset-0 bg-gray-800/70 backdrop-blur-xs transition-opacity"
                x-transition:enter="ease-in-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in-out duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
            ></div>

            <section class="absolute inset-y-0 right-0 pl-10 max-w-full flex">
                <div
                    x-show="showSidebar"
                    class="relative w-screen max-w-md"
                    x-transition:enter="transform transition ease-in-out duration-300"
                    x-transition:enter-start="translate-x-full"
                    x-transition:enter-end="translate-x-0"
                    x-transition:leave="transform transition ease-in-out duration-300"
                    x-transition:leave-start="translate-x-0"
                    x-transition:leave-end="translate-x-full"
                >
                    <div class="h-full flex flex-col bg-white shadow-xl overflow-y-auto">
                        <!-- Header -->
                        <div class="px-4 py-6 bg-blue-700 sm:px-6">
                            <div class="flex items-start justify-between">
                                <h2 class="text-lg font-bold text-white" x-text="isEditing ? 'Edit Tag' : 'Add New Tag'"></h2>
                                <div class="ml-3 h-7 flex items-center">
                                    <button
                                        @click="closeSidebar"
                                        class="text-white hover:text-gray-200 focus:outline-none"
                                    >
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Content -->
                        <form action="{{route('tags.store')}}" method="POST">
                            @csrf
                            <div class="flex-1 p-6">
                                    <div class="space-y-6">
                                        <!-- Tag name field -->
                                        <div>
                                            <label for="tag-name" class="block text-sm font-medium text-gray-700">Tag Name</label>
                                            <input
                                                type="text"
                                                id="tag-name"
                                                name="name"
                                                x-model="newTag.name"
                                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                placeholder="Enter tag name"
                                                required
                                            >
                                        </div>

                                        <!-- Color selector -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Tag Color</label>
                                            <div class="mt-2 grid grid-cols-3 gap-3">
                                                <template x-for="color in colors" :key="color.value">
                                                    <div>
                                                        <label :class="[
                                                            color.bg,
                                                            color.border,
                                                            'cursor-pointer rounded-lg border-2 p-2 flex items-center justify-center h-10',
                                                            newTag.color === color.value ? 'ring-2 ring-offset-2 ring-blue-500' : ''
                                                        ]">
                                                            <input
                                                                type="radio"
                                                                name="color"
                                                                :value="color.value"
                                                                x-model="newTag.color"
                                                                class="sr-only"
                                                            >
                                                            <span x-text="color.name" :class="color.text" class="text-xs font-medium"></span>
                                                        </label>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>

                                        <!-- Preview -->
                                        <div class="border border-gray-200 rounded-lg p-4">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Preview</label>
                                            <div class="flex items-center space-x-2">
                                                <span
                                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium"
                                                    :class="getColorClass(newTag.color, 'bg') + ' ' + getColorClass(newTag.color, 'text')"
                                                >
                                                    <span x-text="newTag.name || 'Tag Preview'"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            <!-- Footer -->
                            <div class="flex-shrink-0 px-4 py-4 border-t border-gray-200">
                                <div class="flex justify-end space-x-3">
                                    <button
                                        type="button"
                                        @click="closeSidebar"
                                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                    >
                                        Cancel
                                    </button>
                                    <button
                                        type="submit"
                                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                    >
                                        <span x-text="isEditing ? 'Update Tag' : 'Save Tag'"></span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
