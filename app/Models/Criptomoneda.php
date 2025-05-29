<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Criptomoneda extends Model
{
    protected $table = 'criptomonedas';

    protected $fillable = [
        'nombre',
        'simbolo',
        'tecnologia'
    ];

    public function monedas(): BelongsToMany
    {
        return $this->belongsToMany(Moneda::class, 'criptomoneda_moneda', 'criptomoneda_id', 'moneda_id')
            ->withPivot('precio')
            ->using(CriptomonedaMoneda::class)
            ->withTimestamps();
    }
}
