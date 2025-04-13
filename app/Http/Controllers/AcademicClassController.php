<?php
namespace App\Http\Controllers;

use App\Models\AcademicClass;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
class AcademicClassController extends Controller
{
    // Display a list of academic classes
    public function index()
    {
        $classes = AcademicClass::paginate(10); // Paginate results
        return view('academic-classes.index', compact('classes'));
    }

    // Show the form for creating a new academic class
    public function create()
    {
        return view('academic-classes.create');
    }

    // Store a newly created academic class in the database
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255|unique:academic_classes,name',
        ]);

        // Create the academic class
        AcademicClass::create($request->only('name'));

        // Redirect with success message
        return redirect()->route('academic-classes.index')
                        ->with('success', 'Academic class created successfully!');
    }


    // Display the specified academic class
    public function show(AcademicClass $academicClass)
    {
        return view('academic-classes.show', compact('academicClass'));
    }

    // Show the form for editing the specified academic class
    public function edit(AcademicClass $academicClass)
    {
        return view('academic-classes.edit', compact('academicClass'));
    }

    // Update the specified academic class in the database
    public function update(Request $request, AcademicClass $academicClass)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:academic_classes,name,' . $academicClass->id,
        ]);

        $academicClass->update($request->only('name'));

        return redirect()->route('academic-classes.index')
                         ->with('success', 'Academic class updated successfully!');
    }

    // Remove the specified academic class from the database
    public function destroy(AcademicClass $academicClass)
    {
        $academicClass->delete();

        return redirect()->route('academic-classes.index')
                         ->with('success', 'Academic class deleted successfully!');
    }
}
