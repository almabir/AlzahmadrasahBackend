<?php
namespace App\Http\Controllers;
namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class FeeController extends Controller
{
    // Show all fees
    public function index()
    {
        $fees = Fee::with('student')->paginate(10);
        return view('fees.index', compact('fees'));
    }
    public function create()
    {
        $students = Student::all(); // Fetch all students for the dropdown
        return view('fees.create', compact('students'));
    }

    public function edit(Fee $fee)
    {
        $students = Student::all(); // Fetch all students for the dropdown
        return view('fees.edit', compact('fee', 'students'));
    }

    public function update(Request $request, Fee $fee)
    {
        // Validate the request
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'fee_type' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'payment_status' => 'required|in:pending,paid',
            'due_date' => 'nullable|date',
            'payment_date' => 'nullable|date',
            'payment_method' => 'nullable|string|max:255',
            'transaction_id' => 'nullable|string|max:255',
        ]);

        // Update the fee
        $fee->update($request->all());

        // Redirect with success message
        return redirect()->route('fees.index')->with('success', 'Fee updated successfully!');
    }
    // Store a new fee record
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'fee_type' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'payment_status' => 'required|in:pending,paid',
            'due_date' => 'nullable|date',
            'payment_date' => 'nullable|date',
            'payment_method' => 'nullable|string|max:255',
            'transaction_id' => 'nullable|string|max:255',
        ]);

        // Create the fee
        Fee::create($request->all());

        // Redirect with success message
        return redirect()->route('fees.index')->with('success', 'Fee created successfully!');
    }

    // Show details of a single fee
    public function show(Fee $fee)
    {
        return view('fees.show', compact('fee'));
    }


    // Delete a fee record
    public function destroy(Fee $fee)
    {
        // Delete the fee
        $fee->delete();

        // Redirect with success message
        return redirect()->route('fees.index')->with('success', 'Fee deleted successfully!');
    }
}
