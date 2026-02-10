<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UploadDetail extends Model
{
    use HasFactory;

    protected $table = 'upload_details';

    // protected $fillable = [
    //     'user_id', 'field_id', 'year', 'semester',
    //     'subject', 'resource_type', 'url', 'file', 'description'
    // ];

    protected $fillable = [
    'user_id',
    'field_id',
    'year',
    'semester',
    'subject',
    'resource_type',
    'url',
    'file',
    'description',
    'uploaded_by',
];

    public function field()
    {
        return $this->belongsTo(Field::class, 'field_id');
    }

   public function user()
    {
        return $this->belongsTo(RegisterUser::class, 'uploaded_by', 'id');
    }

    

}
