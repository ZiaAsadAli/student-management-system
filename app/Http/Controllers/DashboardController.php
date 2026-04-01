<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total'    => Student::count(),
            'admitted' => Student::where('status', 'admitted')->count(),
            'pending'  => Student::where('status', 'pending')->count(),
            'rejected' => Student::where('status', 'rejected')->count(),
        ];

        $recent = Student::latest()->take(5)->get();

        $programStats = Student::select('program', DB::raw('count(*) as total'))
                               ->groupBy('program')
                               ->get();

        return view('dashboard', compact('stats', 'recent', 'programStats'));
    }
}