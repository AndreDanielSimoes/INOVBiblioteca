<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Author extends Model
{
    use HasFactory;

    public function book(string $title): void
    {
        $title = Book::firstOrCreate(['title' => $title]);

        $this->books()->attach($title->id);
    }

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class);
    }
}
