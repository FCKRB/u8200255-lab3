<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bodykit extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'version',
        'name',
        'manufacture_year',
        'bodykit_shop_id',
    ];

    public function bodykit_shop(): BelongsTo
    {
        return $this->belongsTo(BodykitShop::class, 'bodykit_shop_id', 'id');
    }
}
