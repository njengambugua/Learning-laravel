<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $with = ['category', 'author'];
    // protected $fillable = ['title', 'excerpt', 'body'];

    public function scopeFilter($query, array $filters)
    {
        $query->when(isset($filters['search']) ? $filters['search'] : false, function ($query,$search){
            $query->where(fn($query)=>
            $query
              ->where('title', 'like', '%'. $search. '%')
              ->orWhere('body', 'like', '%'. $search. '%')
        );
        });
        
        $query->when(isset($filters['category']) ? $filters['category'] : false, function ($query,$category){
            $query->whereHas('category', fn($query) => $query->where('slug',$category));
        });
        $query->when(isset($filters['author']) ? $filters['author'] : false, function ($query,$author){
            $query->whereHas('author', fn($query) => $query->where('username',$author));
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
