<?php

namespace App\Http\Controllers;
use App\Models\Achievement;

use Illuminate\Http\Request;

class AchievementController extends Controller
{
    public function index()
    {
        $achievements = Achievement::where('student_id', auth()->id())->get();

        return view('achievements.index', compact('achievements'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date_awarded' => 'required|date',
            'type' => 'required|string',
        ]);
    
        Achievement::create([
            'title' => $request->title,
            'description' => $request->description,
            'date_awarded' => $request->date_awarded,
            'type' => $request->type,
            'student_id' => auth()->id(), // Add logged-in user's ID
        ]);
    
        return redirect()->route('dashboard', ['section' => 'achievements'])->with('success', 'Achievement added successfully!');
    }

}
