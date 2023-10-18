<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Journey;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index(Journey $journey)
    {
        return view('documents.index', [
            'journey' => $journey
        ]);
    }

    public function store(Request $request, Journey $journey)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules as needed
        ]);

        $imagePath = $request->file('image')->store('{$journey->id}/documents', 'public'); // Store image in 'public/{$journey->id}/documents' folder

        $document =  new Document();
        $document->imagePath = $imagePath;
        $document->journey_id = $journey->id;
        $document->status = 'PENDING';

        $document->save();

        return redirect()->route('documents.index', [
            'journey' => $journey
        ])->with('success', 'Your document has been added.');
    }

    public function update(Request $request, Document $document, Journey $journey)
    {
        $request->validate([
            'status' => ['required', 'string', 'min:1']
        ]);

        $document->status = $request->get('status');
        $document->save();
    }

    public function destroy(Document $document, Journey $journey)
    {
        $document->delete();

        return redirect()->route('documents.index', [
            'journey' => $journey
        ])->with('success', 'Your document has been deleted.');
    }
}
