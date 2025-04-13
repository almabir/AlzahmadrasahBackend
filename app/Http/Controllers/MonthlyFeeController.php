<?php
namespace App\Http\Controllers;

use App\Models\MonthlyFee;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class MonthlyFeeController extends Controller
{
    public function index()
    {
        try {
            $monthlyFees = MonthlyFee::with('student')->get();
            return response()->json($monthlyFees);
        } catch (Exception $e) {
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'month' => 'required|date_format:Y-m',
            'amount' => 'required|numeric|min:0',
            'payment_status' => 'required|in:pending,paid',
            'due_date' => 'nullable|date',
            'payment_date' => 'nullable|date',
        ]);

        try {
            $monthlyFee = MonthlyFee::create($request->all());
            return response()->json(['message' => 'Monthly fee recorded successfully', 'data' => $monthlyFee], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to record monthly fee'], 500);
        }
    }

    public function show($id)
    {
        try {
            $monthlyFee = MonthlyFee::with('student')->findOrFail($id);
            return response()->json($monthlyFee);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Monthly fee record not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'month' => 'required|date_format:Y-m',
            'amount' => 'required|numeric|min:0',
            'payment_status' => 'required|in:pending,paid',
            'due_date' => 'nullable|date',
            'payment_date' => 'nullable|date',
        ]);

        try {
            $monthlyFee = MonthlyFee::findOrFail($id);
            $monthlyFee->update($request->all());

            return response()->json(['message' => 'Monthly fee updated successfully', 'data' => $monthlyFee]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Monthly fee record not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update monthly fee'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $monthlyFee = MonthlyFee::findOrFail($id);
            $monthlyFee->delete();
            return response()->json(['message' => 'Monthly fee deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Monthly fee record not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to delete monthly fee'], 500);
        }
    }
}
