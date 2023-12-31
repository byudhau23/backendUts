<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $fillable= ['title', 'author', 'description', 'content', 'url', 'url_img', 'published_at', 'category']; 
}
