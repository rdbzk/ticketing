<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Airport extends Model
{
    protected $table = 'airports';

    protected $fillable = [
        'name',
        'code',
        'city_id'
    ];

    protected $appends = [
        'readable_name',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function readableName(): Attribute
    {
        return Attribute::get(
            fn () => $this->code . ' - ' . $this->name
        );
    }
}
