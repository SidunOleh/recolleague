<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'coupon',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function make()
    {
        $coupon = mb_strtoupper(Str::random(5)) . '-' . mt_rand(1000000000000, 9999999999999);

        if (self::firstWhere('coupon', $coupon)) {
            return self::make();
        } else {
            return $coupon;
        }
    }
}
