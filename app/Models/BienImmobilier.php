<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; 

class BienImmobilier extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'surface',
        'prix',
        'ville',
        'adresse',
        'nombre_pieces',
        'nombre_chambres',
        'nombre_sdb',
        'disponible',
        'statut'
    ];

    protected $casts = [
        'prix' => 'decimal:2',
        'disponible' => 'boolean'
    ];

    /**
     * Obtenir les photos associées au bien immobilier.
     */
    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class);
    }

    /**
     * Obtenir la photo principale du bien.
     */
    public function photoPrincipale()
    {
        return $this->photos()->first();
    }

    /**
     * Formater le prix avec la devise.
     */
    public function getPrixFormatAttribute()
    {
        return number_format($this->prix, 0, ',', ' ') . ' CFA';
    }

    /**
     * Obtenir l'URL de la photo principale ou une image par défaut.
     */
    public function getPhotoUrlAttribute()
    {
        $photo = $this->photos()->first();
        return $photo ? asset('storage/' . $photo->chemin) : asset('images/default-property.svg');
    }

    /**
     * Alias pour getPhotoUrlAttribute - utilisé dans les templates.
     */
    public function getImagePrincipaleAttribute()
    {
        return $this->getPhotoUrlAttribute();
    }
}
