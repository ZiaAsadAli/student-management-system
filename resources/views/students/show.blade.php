<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Student Profile</h2>
            <div class="flex gap-2">
                <a href="{{ route('students.edit', $student) }}"
                   class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 text-sm">Edit</a>
                <a href="{{ route('students.index') }}"
                   class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 text-sm">Back</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow overflow-hidden">

                {{-- Header Banner --}}
                <div class="bg-blue-600 px-8 py-6">
                    <h3 class="text-2xl font-bold text-white">{{ $student->name }}</h3>
                    <p class="text-blue-200 mt-1">{{ $student->program }}</p>
                    <span class="mt-3 inline-block px-3 py-1 rounded-full text-xs font-semibold
                        @if($student->status === 'admitted') bg-green-200 text-green-800
                        @elseif($student->status === 'rejected') bg-red-200 text-red-800
                        @else bg-yellow-200 text-yellow-800 @endif">
                        {{ ucfirst($student->status) }}
                    </span>
                </div>

                {{-- Details Grid --}}
                <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach([
                        'Email'         => $student->email,
                        'Phone'         => $student->phone ?? '—',
                        'Gender'        => ucfirst($student->gender ?? '—'),
                        'Date of Birth' => optional($student->date_of_birth)->format('M d, Y') ?? '—',
                        'GPA'           => $student->gpa ?? '—',
                        'Registered'    => $student->created_at->format('M d, Y'),
                    ] as $label => $value)
                    <div>
                        <p class="text-xs text-gray-400 uppercase font-semibold">{{ $label }}</p>
                        <p class="text-gray-800 mt-1">{{ $value }}</p>
                    </div>
                    @endforeach

                    @if($student->address)
                    <div class="md:col-span-2">
                        <p class="text-xs text-gray-400 uppercase font-semibold">Address</p>
                        <p class="text-gray-800 mt-1">{{ $student->address }}</p>
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>