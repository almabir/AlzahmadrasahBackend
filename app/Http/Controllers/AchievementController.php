<?php
namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class AchievementController extends Controller
{
    public function index()
    {
        try {
            $achievements = Achievement::all();
            return response()->json($achievements);
        } catch (Exception $e) {
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'date' => 'required|date',
        ]);

        try {
            $achievement = Achievement::create($request->all());
            return response()->json(['message' => 'Achievement created successfully', 'data' => $achievement], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to create achievement'], 500);
        }
    }

    public function show($id)
    {
        try {
            $achievement = Achievement::findOrFail($id);
            return response()->json($achievement);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Achievement not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'date' => 'required|date',
        ]);

        try {
            $achievement = Achievement::findOrFail($id);
            $achievement->update($request->all());

            return response()->json(['message' => 'Achievement updated successfully', 'data' => $achievement]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Achievement not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update achievement'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $achievement = Achievement::findOrFail($id);
            $achievement->delete();
            return response()->json(['message' => 'Achievement deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Achievement not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to delete achievement'], 500);
        }
    }
}
