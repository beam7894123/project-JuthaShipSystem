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

    public function edit(Document $document)
    {
        return view('documents.edit', [
            'document' => $document
        ]);
    }

    public function update(Request $request, Journey $journey, Document $document)
    {
        $request->validate([
            'status' => ['required', 'string', 'min:1']
        ]);

        $document->status = $request->get('status');
        $document->save();

        return redirect()->route('documents.index', [
            'journey' => $journey
        ])->with('success', 'Your document has been updated.');
    }

    public function destroy(Journey $journey, Document $document)
    {
        $document->delete();

        return redirect()->route('documents.index', [
            'journey' => $journey
        ])->with('success', 'Your document has been deleted.');
    }
}
