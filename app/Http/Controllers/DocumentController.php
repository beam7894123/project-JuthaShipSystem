<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Journey;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function index()
    {
    $user = Auth::user();
    $documents = Document::where('journey_id', $user->journey_id)->get();

//    dd($documents);
    return view('documents.index', [
        'documents' => $documents
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

//    public function pending (Document $document)
//    {
//        $user->status = 'READY';
//        $user->save();
//
//        $users = User::where('journey_id', Auth::user()->journey_id)
//            ->where('role', 'CREW')
//            ->get();
//        $usersForAdmin = User::get();
//        return redirect()->route('crews.index' , [
//            'users' => $users,
//            'usersForAdmin' => $usersForAdmin
//        ])->with('success', "The status of " . $user->name . " has been updated.");
//    }

//    public function approved (Document $document)
//    {
//        $user->status = 'NOTREADY';
//        $user->save();
////        dd($user);
//
//        $users = User::where('journey_id', Auth::user()->journey_id)
//            ->where('role', 'CREW')
//            ->get();
//        $usersForAdmin = User::get();
//        return redirect()->route('crews.index' , [
//            'users' => $users,
//            'usersForAdmin' => $usersForAdmin
//        ])->with('success', "The status of " . $user->name . " has been updated.");
//    }
}
