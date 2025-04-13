<?php
namespace App\Http\Controllers;

use App\Models\Director;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;

class DirectorController extends Controller
{
    // Method to get all directors
    public function indexDev()
    {
        // Fetch all directors from the database (you can apply filtering here if needed)
        $directors = Director::all()->map(function ($item) {
            $item->image = URL::asset(str_replace('storage', 'storage', $item->image));
            return $item;
        });
        
        // Return the directors as a JSON response
        return response()->json($directors);
    }

    public function singleDir($id)
    {
        // Find the director by ID
        $director = Director::find($id);
        $director->image = URL::asset(str_replace('storage', 'storage', $director->image));
        // If director not found, return a 404 response
        if (!$director) {
            return response()->json([
                'success' => false,
                'message' => 'Director not found',
            ], 404);
        }

        // Return the director data as JSON
        return response()->json([
            'success' => true,
            'data' => $director,
        ]);
    }

    public function index()
    {
        $directors = Director::all();
        return view('directors.index', compact('directors'));
    }



    public function create()
    {
        return view('directors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'mobile' => 'nullable|string|max:20',
            'email' => 'required|email|unique:directors,email',
            'post' => 'required|string|max:255',
            'about' => 'nullable|string',
            'social_links' => 'nullable|json',
            'speech' => 'nullable|string',
            'cv' => 'nullable|mimes:pdf|max:2048',
            'category' => 'required|string|in:Board of Director,Deputy Director,Shariah Team,Editor',
        ]);

        $fileName = null;
        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('directors'), $fileName);
        }

        $cvFileName = null;
        if ($request->hasFile('cv')) {
            $cvFileName = time() . '.' . $request->cv->extension();
            $request->cv->move(public_path('cv'), $cvFileName);
        }

        Director::create([
            'name' => $request->name,
            'image' => $fileName ? "directors/" . $fileName : null,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'post' => $request->post,
            'about' => $request->about,
            'social_links' => $request->social_links,
            'speech' => $request->speech,
            'cv' => $cvFileName ? "cv/" . $cvFileName : null,
            'category' => $request->category,
        ]);

        return redirect()->route('directors.index')->with('success', 'Director added successfully!');
    }
    public function show(Director $director)
    {
        return view('directors.show', compact('director'));
    }

    public function edit(Director $director)
    {
        return view('directors.edit', compact('director'));
    }

    public function update(Request $request, Director $director)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'mobile' => 'nullable|string|max:20',
            'email' => 'required|email|unique:directors,email,' . $director->id,
            'post' => 'required|string|max:255',
            'about' => 'nullable|string',
            'social_links' => 'nullable|json',
            'speech' => 'nullable|string',
            'cv' => 'nullable|mimes:pdf|max:2048',
            'category' => 'required|string|in:Board of Director,Deputy Director,Shariah Team,Editor',
        ]);

        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('directors'), $fileName);
            $director->image = "directors/" . $fileName;
        }

        if ($request->hasFile('cv')) {
            $cvFileName = time() . '.' . $request->cv->extension();
            $request->cv->move(public_path('cv'), $cvFileName);
            $director->cv = "cv/" . $cvFileName;
        }

        $director->update([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'post' => $request->post,
            'about' => $request->about,
            'social_links' => $request->social_links,
            'speech' => $request->speech,
            'category' => $request->category,
        ]);

        return redirect()->route('directors.index')->with('success', 'Director updated successfully!');
    }
    public function destroy(Director $director)
    {
        if ($director->image) {
            Storage::delete('public/' . $director->image);
        }

        if ($director->cv) {
            Storage::delete('public/' . $director->cv);
        }

        $director->delete();

        return redirect()->route('directors.index')->with('success', 'Director deleted successfully!');
    }
}
