<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ChatRequestUser extends Pivot
{
    use HasFactory;
    
    public $incrementing = true;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function chatRequest(): BelongsTo
    {
        return $this->belongsTo(ChatRequest::class);
    }

    public static function latest()
    {
        return self::orderBy('created_at', 'DESC')
            ->limit(10)
            ->get();
    }
}
