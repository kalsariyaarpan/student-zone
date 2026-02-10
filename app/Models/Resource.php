<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    // 👇 This tells Laravel to use the correct table
    protected $table = 'upload_details';

    protected $fillable = ['user_id', 'field_id', 'year', 'semester', 'subject','resource_type', 'url', 'file', 'description'
    ];

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function user()
    {


        return $this->belongsTo(RegisterUser::class, 'user_id'  );
return $this->belongsTo(RegisterUser::class, 'uploaded_by');

        // return $this->belongsTo(RegisterUser::class, 'user_id',);
        //   return $this->belongsTo(User::class, 'uploaded_by'); 
    }

        
public function viewResources()
{
    $resources = Resource::orderBy('created_at', 'desc')->get();
    return view('fields.view-resources', compact('resources'));
}

}