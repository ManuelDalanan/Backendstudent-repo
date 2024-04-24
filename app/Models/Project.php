<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = ['id', 'type', 'title', 'author', 'course_id', 'image_location', 'date_published',
                            'language', 'abstract'];

    public function course()
    {
        return $this->belongsTo(Department::class);
    }
}
