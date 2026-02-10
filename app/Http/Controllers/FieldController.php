<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;;   
use App\Models\UploadDetail;
use App\Helpers\CoverGenerator;
use Illuminate\Support\Facades\DB;




class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $fields = Field::select('id', 'name')->get();
    return view('fields.index', compact('fields'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    

        $validated = validator($request->all(), [
            'field_id' => 'required|integer',
            'year' => 'required|string',
            'semester' => 'required|string',
            'subject' => 'required|string',
            'resource_type' => 'required|string',
            'url' => 'nullable|url',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png',
            'description' => 'nullable|string',
        ])->validate();

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads', 'public');
        }   

 // 2️⃣ Generate cover image (THIS WAS MISSING)
    // $coverPath = CoverGenerator::generate(
    //     $request->subject,
    //     $request->resource_type
    // );

    $coverPath = null;

    // dd($coverPath); // DEBUGGING LINE
        UploadDetail::create([
            'user_id' => Auth::id(),
            'field_id' => $request->field_id,
            'year' => $request->year,
            'semester' => $request->semester,
            'subject' => $request->subject,
            'resource_type' => $request->resource_type,
            'url' => $request->url,
            'file' => $filePath,
            'description' => $request->description,
            'uploaded_by' => Auth::id(),
            'cover_image' => $coverPath,

        ]);

        // return redirect()->route('fields.upload')->with('success', 'Resource uploaded successfully!');
    
    // return response()->json([
    //     'status' => 'success',
    //     'message' => 'Upload completed successfully'
    // ], 200);
        

            return response()->json([
            'status' => 'success'
        ]);

    //         return redirect()
    // ->route('home')
    // ->with('success', 'Resource uploaded successfully!');



            }
        public function viewResources()
{
    $resources = UploadDetail::latest()->get();
    return view('fields.view-resources', compact('resources'));
}


    /**
     * Display the specified resource.
     */
    public function show(Field $field)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Field $field)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Field $field)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Field $field)
    {
        //
    }
}
