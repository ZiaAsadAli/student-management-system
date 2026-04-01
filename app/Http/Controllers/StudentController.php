<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('program')) {
            $query->where('program', 'like', '%' . $request->program . '%');
        }

        $students = $query->latest()->paginate(10)->withQueryString();

        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
			'email'         => 'required|email|unique:students,email',
			'phone'         => 'required|string|max:20',
			'program'       => 'required|string|max:255',
			'status'        => 'required|in:pending,admitted,rejected',
			'gender'        => 'required|in:male,female,other',
			'date_of_birth' => 'required|date|before:' . now()->subYears(18)->format('Y-m-d'),
			'address'       => 'required|string',
			'gpa'           => 'required|numeric|min:0|max:4',
        ]);

        Student::create($validated);

        return redirect()->route('students.index')
                         ->with('success', 'Student added successfully!');
    }

    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
			'name'          => 'required|string|max:255',
			'email'         => 'required|email|unique:students,email,' . $student->id,
			'phone'         => 'required|string|max:20',
			'program'       => 'required|string|max:255',
			'status'        => 'required|in:pending,admitted,rejected',
			'gender'        => 'required|in:male,female,other',
			'date_of_birth' => 'required|date|before:' . now()->subYears(18)->format('Y-m-d'),
			'address'       => 'required|string',
			'gpa'           => 'required|numeric|min:0|max:4',
		]);

        $student->update($validated);

        return redirect()->route('students.index')
                         ->with('success', 'Student updated successfully!');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
                         ->with('success', 'Student deleted successfully!');
    }
	
	public function exportPdf()
	{
		$students = Student::orderBy('name')->get();
		$pdf = Pdf::loadView('students.pdf', compact('students'))
				  ->setPaper('a4', 'landscape');
		return $pdf->download('students-list.pdf');
	}
}