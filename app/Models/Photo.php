<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; 

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'bien_immobilier_id',
        'chemin',
        'alt_text',
        'ordre'
    ];

    /**
     * Obtenir le bien immobilier auquel la photo appartient.
     */
    public function bienImmobilier(): BelongsTo
    {
        return $this->belongsTo(BienImmobilier::class);
    }

    /**
     * Obtenir l'URL complète de la photo.
     */
    public function getUrlAttribute()
    {
        return asset('storage/' . $this->chemin);
    }
}
