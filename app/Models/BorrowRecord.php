<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BorrowRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'borrowed_at',
        'due_date',
        'returned_at',
    ];

    protected $casts = [
        'borrowed_at' => 'datetime',
        'due_date' => 'datetime',
        'returned_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($record) {
            if (!$record->due_date) {
                $record->due_date = $record->borrowed_at->addDays(14);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function scopeOnlyBorrowed($query)
    {
        return $query->whereNull('returned_at');
    }
}
