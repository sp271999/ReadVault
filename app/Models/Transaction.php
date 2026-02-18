<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
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
        'borrowed_at' => 'date',
        'due_date'    => 'date',
        'returned_at' => 'date',
    ];

    public function isReturned(): bool
    {
        return !is_null($this->returned_at);
    }

    public function isOverdue(): bool
    {
        if ($this->isReturned() || !$this->due_date) return false;
        return now()->startOfDay()->gt($this->due_date->startOfDay());
    }

    public function overdueDays(): int
    {
        if (!$this->isOverdue()) return 0;
        return now()->startOfDay()->diffInDays($this->due_date->startOfDay());
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
