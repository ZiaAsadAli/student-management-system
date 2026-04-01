<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <p class="text-gray-500 text-sm">Total Students</p>
                    <p class="text-4xl font-bold text-blue-600">{{ $stats['total'] }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <p class="text-gray-500 text-sm">Admitted</p>
                    <p class="text-4xl font-bold text-green-600">{{ $stats['admitted'] }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <p class="text-gray-500 text-sm">Pending</p>
                    <p class="text-4xl font-bold text-yellow-500">{{ $stats['pending'] }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <p class="text-gray-500 text-sm">Rejected</p>
                    <p class="text-4xl font-bold text-red-500">{{ $stats['rejected'] }}</p>
                </div>
            </div>

            {{-- Charts Row --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

                {{-- Pie Chart --}}
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Admission Status</h3>
                    <canvas id="statusChart" height="250"></canvas>
                </div>

                {{-- Bar Chart --}}
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Students by Program</h3>
                    <canvas id="programChart" height="250"></canvas>
                </div>

            </div>

            {{-- Recent Students --}}
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-700">Recent Admissions</h3>
                    <a href="{{ route('students.index') }}" class="text-blue-600 text-sm hover:underline">View All</a>
                </div>
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Program</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recent as $student)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium">{{ $student->name }}</td>
                            <td class="px-4 py-3 text-gray-500">{{ $student->program }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold
                                    @if($student->status === 'admitted') bg-green-100 text-green-700
                                    @elseif($student->status === 'rejected') bg-red-100 text-red-700
                                    @else bg-yellow-100 text-yellow-700 @endif">
                                    {{ ucfirst($student->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-gray-400">{{ $student->created_at->format('M d, Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-gray-400">No students yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
    <script>
        // Status Pie Chart
        new Chart(document.getElementById('statusChart'), {
            type: 'doughnut',
            data: {
                labels: ['Admitted', 'Pending', 'Rejected'],
                datasets: [{
                    data: [{{ $stats['admitted'] }}, {{ $stats['pending'] }}, {{ $stats['rejected'] }}],
                    backgroundColor: ['#16a34a', '#eab308', '#dc2626'],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });

        // Program Bar Chart
        new Chart(document.getElementById('programChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($programStats->pluck('program')) !!},
                datasets: [{
                    label: 'Students',
                    data: {!! json_encode($programStats->pluck('total')) !!},
                    backgroundColor: ['#3b82f6','#8b5cf6','#06b6d4','#f59e0b','#10b981'],
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 } }
                }
            }
        });
    </script>

</x-app-layout>