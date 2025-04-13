<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentReportExport;
use App\Models\Student; 
use App\Models\AcademicClass; 
use Barryvdh\DomPDF\Facade\Pdf;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('class', 'parentDetails', 'localGuardian')->paginate(100);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        // Fetch available academic classes to display in the form
        $academicClasses  = AcademicClass::all();

        return view('students.create', compact('academicClasses'));
    }
    public function edit(Student $student)
    {
        $academicClasses = AcademicClass::all(); // Fetch all academic classes
        return view('students.edit', compact('student', 'academicClasses'));
    }
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:students,email',
            'mobile' => 'nullable|string|max:15',
            'dob' => 'nullable|date',
            'class_id' => 'required|exists:academic_classes,id',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:10',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle profile image upload
        $imageName = null;
        if ($request->hasFile('profile_image')) {
            $imageName = time() . '.' . $request->profile_image->extension();
            $request->profile_image->move(public_path('uploads/students'), $imageName);
        }

        // Create the student
        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'dob' => $request->dob,
            'class_id' => $request->class_id,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip_code' => $request->zip_code,
            'profile_image' => $imageName,
        ]);

        // Redirect with success message
        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }

    public function show(Student $student)
    {
        // Fetch the student's details with related data (e.g., class, achievements, fees, etc.)
        $student->load('class', 'achievements', 'fees', 'parentDetails', 'localGuardian');

        // Pass the student data to the view
        return view('students.show', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:students,email,' . $student->id,
            'mobile' => 'nullable|string|max:17',
            'dob' => 'nullable|date',
            'class_id' => 'required|exists:academic_classes,id',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:10',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle profile image upload
        $imageName = $student->profile_image; // Keep the existing image by default
        if ($request->hasFile('profile_image')) {
            // Delete the old image if it exists
            if ($student->profile_image && file_exists(public_path('uploads/students/' . $student->profile_image))) {
                unlink(public_path('uploads/students/' . $student->profile_image));
            }

            // Upload the new image
            $imageName = time() . '.' . $request->profile_image->extension();
            $request->profile_image->move(public_path('uploads/students'), $imageName);
        }

        // Update the student
        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'dob' => $request->dob,
            'class_id' => $request->class_id,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip_code' => $request->zip_code,
            'profile_image' => $imageName,
        ]);

        // Redirect with success message
        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->back()->with('success', 'Student deleted successfully!');
    }

    public function export()
    {
        return Excel::download(new StudentReportExport, 'students.xlsx');
    }

    public function downloadPdf(Student $student)
    {
        // Load the student data with related information
        $student->load('class', 'achievements', 'fees', 'parentDetails', 'localGuardian');

        // Generate the PDF
        $pdf = Pdf::loadView('students.pdf', compact('student'));

        // Download the PDF
        return $pdf->download('student-details-' . $student->id . '.pdf');
    }

}
