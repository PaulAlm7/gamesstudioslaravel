<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['studio_id', 'name', 'cover', 'release_date'])]
class Game extends Model
{
    public function studio(): BelongsTo
    {
        return $this->belongsTo(Studio::class);
    }
}
