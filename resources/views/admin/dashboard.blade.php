
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Statistics</h3>
                        <div class="mt-3 text-sm">
                            <p>Total Content Pages: {{ $totalPages }}</p>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Recent Content Pages</h3>
                        <div class="mt-3">
                            @if($recentPages->count() > 0)
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($recentPages as $page)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $page->title }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $page->slug }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                        <a href="{{ route('admin.edit', $page) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-sm text-gray-500">No content pages yet.</p>
                            @endif
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('admin.content') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            View All Content
                        </a>
                        <a href="{{ route('admin.create') }}" class="ml-4 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                            Create New Content
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
