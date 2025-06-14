<?php

namespace App\Http\Controllers;

use App\Models\CourseWorkshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseWorkshopController extends Controller
{
    public function index()
    {
        $coursesWorkshops = CourseWorkshop::where('user_id', Auth::id())->get();
        return view('courses_workshops.index', compact('coursesWorkshops'));
    }

    public function create()
    {
        return view('courses_workshops.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'organizer' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'type' => 'required|in:Course,Workshop',
            'mode' => 'required|in:Online,Offline,Hybrid',
            'certificate' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $certificatePath = $request->file('certificate')?->store('certificates');

        CourseWorkshop::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'organizer' => $request->organizer,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'type' => $request->type,
            'mode' => $request->mode,
            'skills_acquired' => $request->skills_acquired,
            'certificate' => $certificatePath,
        ]);

        //return redirect()->route('courses_workshops.index')->with('success', 'Entry added successfully.');
        return redirect()->route('dashboard')->with('success', 'Added successfully!');

    }

    public function edit(CourseWorkshop $courseWorkshop)
    {
        $this->authorize('view', $courseWorkshop);
        return view('courses_workshops.edit', compact('courseWorkshop'));
    }

    public function update(Request $request, CourseWorkshop $courseWorkshop)
    {
        $this->authorize('update', $courseWorkshop);

        $request->validate([
            'title' => 'required|string|max:255',
            // Other validations
        ]);

        // Update logic

        return redirect()->route('courses_workshops.index');
    }

    public function destroy($id)
    {
        // $this->authorize('delete', $courseWorkshop);
        // $courseWorkshop->delete();
        $courseWorkshop= CourseWorkshop::where('user_id', Auth::id())->findOrFail($id);
        $courseWorkshop->delete();
        return redirect()->route('dashboard')->with('success', 'Entry deleted successfully.');
    }
}
