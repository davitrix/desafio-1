<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CriptomonedaMoneda extends Pivot
{
    protected $table = 'criptomoneda_moneda';

    protected $fillable = [
        'criptomoneda_id',
        'moneda_id',
        'precio',
    ];

    public $incrementing = true;

    public $timestamps = true;

    protected $casts = [
        'criptomoneda_id' => 'integer',
        'moneda_id' => 'integer',
        'precio' => 'decimal:8',
    ];

    public function criptomoneda(): BelongsTo
    {
        return $this->belongsTo(Criptomoneda::class, 'criptomoneda_id');
    }

    public function moneda(): BelongsTo
    {
        return $this->belongsTo(Moneda::class, 'moneda_id');
    }
}
