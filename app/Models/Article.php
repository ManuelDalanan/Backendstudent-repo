<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['id', 'title', 'author', 'language', 'subject', 'date_published',
                            'volume', 'issue', 'page', 'abstract', 'remarks'];
}