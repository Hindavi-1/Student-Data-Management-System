<?php

namespace App\Http\Controllers;
use App\Models\Internship;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class InternshipController extends Controller
{
    //
    public function index(Request $request)
    {
        $internships = Internship::where('student_id', auth()->id())->get();
        
        if ($internships->isEmpty()) {
            return view('internships.partial', compact('internships'));
        } else {
            return view('internships.index', compact('internships'));
        }
    }


    
    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'email' => 'required|email',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string|in:Active,Completed',
        ]);
    
        // Create a new internship record
        Internship::create([
            'student_id' => auth()->id(), // Store the logged-in user's ID
            'student_name' => auth()->user()->name, // Store the logged-in user's name
            'email' => $validatedData['email'],
            'company_name' => $validatedData['company_name'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'status' => $validatedData['status'],
        ]);
    
        // Redirect to the dashboard section with a success message
        return redirect()->route('dashboard', ['section' => 'internships'])
            ->with('success', 'Internship added successfully!');
    }
    


    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:Active,Completed',
        ]);

        // Find the internship by ID
        $internship = Internship::findOrFail($id);

        // Update the internship with the new data
        $internship->update([
            'company_name' => $validated['company_name'],
            'email' => $validated['email'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'status' => $validated['status'],
        ]);

        // Redirect back to the internships page with a success message
        return redirect()->route('dashboard', ['section' => 'internships'])
        ->with('success', 'Internship updated successfully.');
    }


    public function show($id)
    {
        try {
            $internship = Internship::findOrFail($id);
            return response()->json($internship);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internship not found'], 404);
        }
    }



    public function destroy($id)
    {
        // $internship = Internship::where('student_id', Auth::id())->findOrFail($id);
        // $internship->delete();

        // return redirect()->route('dashboard', ['section' => 'internships'])->with('success', 'Internship deleted successfully.');

        $internship = Internship::where('student_id', Auth::id())->findOrFail($id);
        $internship->delete();

         return redirect()->route('dashboard')->with('success', 'Internship deleted successfully.');

    }

}
