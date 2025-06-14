<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaperPublication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PaperPublicationController extends Controller
{
    public function index()
    {
        $publications = PaperPublication::where('user_id', Auth::id())->get();
        return view('paper_publications.index', compact('publications'));
    }

    public function show($id)
    {
        try {
            $pp = PaperPublication::findOrFail($id);
            return response()->json($pp);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internship not found'], 404);
        }
    }

    public function create()
    {
        return view('paper_publications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'authors' => 'required|string|max:255',
            'journal_name' => 'required|string|max:255',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $documentPath = null;
        if ($request->hasFile('document')) {
            $filename=$request->file('document')->getClientOriginalName();
            $documentPath = $request->file('document')->storeAs('public/documents',$filename);
        }

        PaperPublication::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'authors' => $request->authors,
            'abstract' => $request->abstract,
            'journal_name' => $request->journal_name,
            'publisher' => $request->publisher,
            'doi' => $request->doi,
            'publication_date' => $request->publication_date,
            'document_path' => $documentPath,
        ]);

        return redirect()->route('dashboard')->with('success', 'Publication added successfully!');
    }

    public function edit($id)
    {
        $publication = PaperPublication::where('user_id', Auth::id())->findOrFail($id);
        return view('paper_publications.edit', compact('publication'));
    }

    public function update(Request $request, $id)
    {
        $publication = PaperPublication::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'authors' => 'required|string|max:255',
            'journal_name' => 'required|string|max:255',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $documentPath = $publication->document_path;

        if ($request->hasFile('document')) {
            if ($documentPath) {
                Storage::delete($documentPath);
            }
            $documentPath = $request->file('document')->store('public/documents');
        }

        $publication->update([
            'title' => $request->title,
            'authors' => $request->authors,
            'abstract' => $request->abstract,
            'journal_name' => $request->journal_name,
            'publisher' => $request->publisher,
            'doi' => $request->doi,
            'publication_date' => $request->publication_date,
            'document_path' => $documentPath,
        ]);

        return redirect()->route('paper-publications.index')->with('success', 'Publication updated successfully!');
    }

    public function destroy($id)
    {
        $publication = PaperPublication::where('user_id', Auth::id())->findOrFail($id);

        if ($publication->document_path) {
            Storage::delete($publication->document_path);
        }

        $publication->delete();

        return redirect()->route('dashboard')->with('success', 'Publication deleted successfully!');
    }
}
