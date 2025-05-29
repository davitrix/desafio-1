<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Moneda extends Model
{
    protected $table = 'monedas';

    protected $fillable = [
        'nombre',
        'simbolo',
        'pais'
    ];

    public function criptomonedas(): BelongsToMany
    {
        return $this->belongsToMany(Criptomoneda::class, 'criptomoneda_moneda', 'moneda_id', 'criptomoneda_id')
            ->withPivot('precio')
            ->using(CriptomonedaMoneda::class)
            ->withTimestamps();
    }
}
