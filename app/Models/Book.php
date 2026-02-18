<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class Book extends Model
{
    //
    use HasFactory;
     protected $fillable = [
        'title',
        'author',
        'category_id',
        'quantity',
        'image',
    ];
  
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return Storage::url($this->image); // returns /storage/books/...
        }
        return asset('images/book-placeholder.png');
    }





    public function transactions()
{
    return $this->hasMany(Transaction::class);
}

public function category()
{
    return $this->belongsTo(Category::class);
}


}
