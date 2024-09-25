<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    /**
     * Get the user who is the owner of the post
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
