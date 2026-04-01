<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">All Students</h2>
            <div class="flex gap-2">
			<a href="{{ route('students.export.pdf') }}"
			   class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 text-sm">
				Export PDF
			</a>
			<a href="{{ route('students.create') }}"
			   class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-sm">
				+ Add Student
			</a>
</div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Flash Message --}}
            @if(session('success'))
                <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Search & Filter --}}
            <div class="bg-white p-4 rounded-lg shadow mb-6">
                <form method="GET" action="{{ route('students.index') }}" class="flex flex-wrap gap-3">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Search by name or email..."
                           class="border rounded-lg px-3 py-2 text-sm flex-1 min-w-48">

                    <select name="status" class="border rounded-lg px-3 py-2 text-sm">
                        <option value="">All Statuses</option>
                        <option value="pending"  {{ request('status') == 'pending'  ? 'selected' : '' }}>Pending</option>
                        <option value="admitted" {{ request('status') == 'admitted' ? 'selected' : '' }}>Admitted</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>

                    <input type="text" name="program" value="{{ request('program') }}"
                           placeholder="Filter by program..."
                           class="border rounded-lg px-3 py-2 text-sm">

                    <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-sm">
                        Search
                    </button>
                    <a href="{{ route('students.index') }}"
                       class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 text-sm">
                        Reset
                    </a>
                </form>
            </div>

            {{-- Table --}}
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-4">#</th>
                            <th class="px-6 py-4">Name</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Program</th>
                            <th class="px-6 py-4">GPA</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $index => $student)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-6 py-4 text-gray-400">{{ $students->firstItem() + $loop->index }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $student->name }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $student->email }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $student->program }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $student->gpa ?? '—' }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold
                                    @if($student->status === 'admitted') bg-green-100 text-green-700
                                    @elseif($student->status === 'rejected') bg-red-100 text-red-700
                                    @else bg-yellow-100 text-yellow-700 @endif">
                                    {{ ucfirst($student->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('students.show', $student) }}"
                                       class="text-blue-600 hover:underline text-xs">View</a>
                                    <a href="{{ route('students.edit', $student) }}"
                                       class="text-yellow-600 hover:underline text-xs">Edit</a>
                                    <form method="POST" action="{{ route('students.destroy', $student) }}"
                                          onsubmit="return confirm('Delete this student?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="text-red-600 hover:underline text-xs">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-gray-400">
                                No students found.
                                <a href="{{ route('students.create') }}" class="text-blue-600 hover:underline">Add one?</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Pagination --}}
                @if($students->hasPages())
                <div class="px-6 py-4 border-t">
                    {{ $students->links() }}
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>