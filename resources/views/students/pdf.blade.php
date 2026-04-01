<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Students List</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #333; }

        .header { background-color: #1d4ed8; color: white; padding: 20px; margin-bottom: 20px; }
        .header h1 { font-size: 22px; font-weight: bold; }
        .header p { font-size: 11px; margin-top: 4px; opacity: 0.85; }

        .stats { display: flex; gap: 12px; margin: 0 20px 20px 20px; }
        .stat-box { flex: 1; padding: 10px; border-radius: 6px; text-align: center; }
        .stat-box .number { font-size: 22px; font-weight: bold; }
        .stat-box .label { font-size: 10px; margin-top: 2px; }
        .stat-total    { background: #eff6ff; color: #1d4ed8; }
        .stat-admitted { background: #f0fdf4; color: #16a34a; }
        .stat-pending  { background: #fefce8; color: #ca8a04; }
        .stat-rejected { background: #fef2f2; color: #dc2626; }

        table { width: calc(100% - 40px); margin: 0 20px; border-collapse: collapse; }
        thead tr { background-color: #1d4ed8; color: white; }
        thead th { padding: 10px 8px; text-align: left; font-size: 10px; text-transform: uppercase; }
        tbody tr:nth-child(even) { background-color: #f8fafc; }
        tbody tr { border-bottom: 1px solid #e2e8f0; }
        tbody td { padding: 9px 8px; }

        .badge { padding: 3px 8px; border-radius: 20px; font-size: 9px; font-weight: bold; }
        .badge-admitted { background: #dcfce7; color: #16a34a; }
        .badge-pending  { background: #fef9c3; color: #ca8a04; }
        .badge-rejected { background: #fee2e2; color: #dc2626; }

        .footer { margin-top: 20px; text-align: center; font-size: 10px; color: #94a3b8; }
    </style>
</head>
<body>

    {{-- Header --}}
    <div class="header">
        <h1>Student Management System</h1>
        <p>Generated on {{ now()->format('F d, Y \a\t h:i A') }} &nbsp;|&nbsp; Total Records: {{ $students->count() }}</p>
    </div>

    {{-- Stats --}}
    <div class="stats">
        <div class="stat-box stat-total">
            <div class="number">{{ $students->count() }}</div>
            <div class="label">Total</div>
        </div>
        <div class="stat-box stat-admitted">
            <div class="number">{{ $students->where('status', 'admitted')->count() }}</div>
            <div class="label">Admitted</div>
        </div>
        <div class="stat-box stat-pending">
            <div class="number">{{ $students->where('status', 'pending')->count() }}</div>
            <div class="label">Pending</div>
        </div>
        <div class="stat-box stat-rejected">
            <div class="number">{{ $students->where('status', 'rejected')->count() }}</div>
            <div class="label">Rejected</div>
        </div>
    </div>

    {{-- Table --}}
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Program</th>
                <th>GPA</th>
                <th>Gender</th>
                <th>Status</th>
                <th>Registered</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $index => $student)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td><strong>{{ $student->name }}</strong></td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->program }}</td>
                <td>{{ $student->gpa ?? '—' }}</td>
                <td>{{ ucfirst($student->gender ?? '—') }}</td>
                <td>
                    <span class="badge badge-{{ $student->status }}">
                        {{ ucfirst($student->status) }}
                    </span>
                </td>
                <td>{{ $student->created_at->format('M d, Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align:center; padding: 20px; color: #94a3b8;">
                    No students found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Student Management System &mdash; Confidential Document
    </div>

</body>
</html>