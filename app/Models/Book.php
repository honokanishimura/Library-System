<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author_name', 'isbn', 'image', 'lended', 'genre_id', 'status', 'description', 'return_date'];



    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }


    public function borrowRecords()
{
    return $this->hasMany(BorrowRecord::class);
}

}
