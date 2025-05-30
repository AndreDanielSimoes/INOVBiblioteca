<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    protected $fillable = ['user_id', 'book_id', 'requested_at', 'delivery_date'];

    protected $casts = [
        'requested_at' => 'datetime',
        'delivery_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function scopeActive($query)
    {
        return $query->whereDate('delivery_date', '>=', now());
    }

    public function scopeRecent($query)
    {
        return $query->where('requested_at', '>=', now()->subDays(30));
    }
}
