<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Student — {{ $student->name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-8">
                <form method="POST" action="{{ route('students.update', $student) }}">
                    @csrf @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @include('students._form')
                    </div>
                    <div class="flex gap-3 mt-8">
                        <button type="submit"
                                class="bg-yellow-500 text-white px-6 py-2 rounded-lg hover:bg-yellow-600">
                            Update Student
                        </button>
                        <a href="{{ route('students.index') }}"
                           class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>