<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{   
    use HasFactory, SoftDeletes; // Thêm SoftDeletes và HasFactory
    protected $table = 'books';
    protected $dates = ['published_at', 'deleted_at']; // Thêm 'deleted_at'

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
