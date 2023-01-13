<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory;

    protected $fillable=['category_id','post_id'];

    public function posts()
    {
        return $this->belongsTo(User::class);
    }
    public function categores()
    {
        return $this->belongsTo(User::class);
    }
    
}
