<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resource; // adjust if your model name is different
use App\Models\UploadDetail;

class ExploreController extends Controller
{
    
     public function index()
    {
        $resources = UploadDetail::with('user')
            ->orderBy('id', 'desc')
            ->get();

        // DEBUG (uncomment once)
        // dd($resources);

        return view('fields.explore', compact('resources'));
}

}
