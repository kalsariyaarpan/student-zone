<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\UploadDetail;
use App\Models\Note;
use App\Models\User;

class ProfileController extends Controller
{
    
    public function show()
    {
        
      

        $user = Auth::user();

        $docCount = \App\Models\UploadDetail::where('user_id', Auth::id())->count();
        // $docCount = UploadDetail::where('user_id', Auth::id())->count();

        // Example stats - replace with real models if needed
        // $docCount = 0;
        $qrCount = 0;
        $notesCount = 0;
        $tasksCount = 0;

        return view('account.profile', compact('user', 'docCount', 'qrCount', 'notesCount', 'tasksCount'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name'     => 'required|string|max:50',
            'last_name'      => 'required|string|max:50',
            'username'       => 'required|string|max:50|unique:register_users,username,' . $user->id,
            'profile_photo'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Update normal fields
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;

        // Handle file upload
        if ($request->hasFile('profile_photo')) {

            if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo = $path;
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|confirmed|min:6',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password is incorrect.');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password updated successfully!');
    }

        // New method for "My Documents" page
        public function myDocuments()
{
    $userId = Auth::id();

    // Get ALL documents uploaded by user
    $docs = UploadDetail::where('user_id', $userId)
                ->latest()
                ->get();

    return view('account.my-documents', compact('docs'));
}


    
// delete
public function deleteDocument($id)
{
    $doc = UploadDetail::where('id', $id)
        ->where('user_id', Auth::id()) // security: only owner
        ->firstOrFail();

    // Delete file from storage
    if ($doc->file && Storage::disk('public')->exists($doc->file)) {
        Storage::disk('public')->delete($doc->file);
    }

    // Delete DB record
    $doc->delete();

    return back()->with('success', 'Document deleted successfully.');
}


    // edit
public function editDocument($id)
{
     $doc = UploadDetail::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    return view('account.edit-document', compact('doc'));
}

public function updateDocument(Request $request, $id)
{
    $doc = UploadDetail::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    $rules = [
        'subject' => 'required|string|max:255',
        'year' => 'required|string',
        'semester' => 'required|string',
    ];

    // URL based document
    if ($doc->resource_type === 'external') {
        $rules['url'] = 'required|url';
    }

    // File based document
    if ($doc->resource_type !== 'external') {
        $rules['file'] = 'nullable|file|max:10240';
    }

    $request->validate($rules);

    $doc->subject = $request->subject;
    $doc->year = $request->year;
    $doc->semester = $request->semester;

    // Update URL
    if ($doc->resource_type === 'external') {
        $doc->url = $request->url;
    }

    // Replace file
    if ($request->hasFile('file')) {
        if ($doc->file && \Storage::disk('public')->exists($doc->file)) {
            \Storage::disk('public')->delete($doc->file);
        }

        $doc->file = $request->file('file')->store('uploads', 'public');
    }

    $doc->save();

    return redirect()
        ->route('my.documents')
        ->with('success', 'Document updated successfully!');
}

}
