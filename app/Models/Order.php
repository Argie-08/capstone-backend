<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        "item",
        "price",
        "quantity",
        "total",
        "user_id"
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

}
