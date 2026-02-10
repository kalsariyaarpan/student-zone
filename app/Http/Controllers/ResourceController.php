<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resource;    
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\UploadDetail;
use App\Models\Field;


class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */    
   public function index()
    {
        // asc, desc
        // $resources = Resource::with('field')->where('user_id', Auth::id())->get();
        // return view('fields.upload-resources', compact('resources'));
    
        // $users =  RegisterUser::orderBy('created_at' , 'desc')->take(1)->get();
        // return view('fields.index',compact('users'));

        $fields = Field::all(); // for step 1
        $resources = Resource::with('field')->where('user_id', Auth::id())->get();

        return view('fields.upload-resources', compact('fields', 'resources'));
    /**
     * Show the form for creating a new resource.
     */
    }


   public function select()
{
    $fields = Field::select('id','name')->orderBy('name')->get();

    return view('fields.select', [
        'step' => 1,
        'fields' => $fields
    ]);
}


//   public function chooseType(Request $request)
// {
//     return view('fields.select', [
//         'step' => 2,
//         'field' => $request->input('field'),
//         'year' => $request->input('year'),
//         'semester' => $request->input('semester'),
//         'subject' => $request->input('subject'),
//     ]);
// }

public function chooseType(Request $request)
{
    $fields = Field::select('id', 'name')->orderBy('name')->get();

    $validated = $request->validate(
        [
            'field'    => 'required|exists:fields,id',
            'year'     => 'required|in:First,Second,Third',
            'semester' => 'required|in:1,2,3,4,5,6',
            'subject'  => 'required|string|min:2',
        ],
        [
            'field.required'    => 'Please select a field.',
            'year.required'     => 'Please select a year.',
            'semester.required' => 'Please select a semester.',
            'subject.required'  => 'Please enter subject name.',
        ]
    );

    return view('fields.select', [
        'step'     => 2,
        'fields'   => $fields, // ✅ VERY IMPORTANT
        'field'    => $validated['field'],
        'year'     => $validated['year'],
        'semester' => $validated['semester'],
        'subject'  => $validated['subject'],
    ]);
}
  


  public function showFinal(Request $request)
{
    $field_id = $request->input('field');
    $year = $request->input('year');
    $semester = $request->input('semester');
    $subject = $request->input('subject');
    $type = $request->input('type');

    $subjectNormalized = is_string($subject) ? trim(mb_strtolower($subject)) : null;

    $resources = UploadDetail::query()
        ->where('field_id', $field_id)
        ->where('year', $year)
        ->where('semester', $semester)
        ->when($subjectNormalized, function ($q) use ($subjectNormalized) {
            $q->whereRaw('LOWER(subject) = ?', [$subjectNormalized]);
        })
        ->when($type, function ($q) use ($type) {
            $q->where('resource_type', $type);
        })
        ->latest()
        ->get();

    return view('fields.select', [
        'step' => 3,
        'type' => $type,
        'resources' => $resources
    ]);
}


    
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
    {



       $validated = $request->validate([
            'field_id' => 'required|integer',
            'year' => 'required|string',
            'semester' => 'required|string',
            'subject' => 'required|string',
            'resource_type' => 'required|string',
            'url' => 'nullable|url',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png',
            'description' => 'nullable|string',
        ]); 

       // Handle file upload
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads', 'public');
        }

            Resource::create([
            'user_id' => Auth::user()->id,
            'field_id' => $request->field_id,
            'year' => $request->year,
            'semester' => $request->semester,
            'subject' => $request->subject,
            'resource_type' => $request->resource_type,
            'url' => $request->url,
            'file' => $filePath,
            'description' => $request->description,
       
    
              

    
        ]);

        
          
        // return redirect()->route('home')->with('success', 'Resource uploaded successfully!');
        return redirect()->route('resource.form')->with('success', 'Resource uploaded successfully!');
       
    }




    /**
     * Display the specified resource.
     */
    public function show(Resource $resource)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resource $resource)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resource $resource)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resource $resource)
    {
        //
    }
}
