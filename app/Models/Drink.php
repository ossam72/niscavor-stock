<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    protected $fillable = [
        'nom',
        'categorie',
        'quantite_stock',
        'prix_unitaire',
        'image',          // ← nouveau champ photo
    ];

    /**
     * Pattern Accessor — retourne l'URL de l'image ou un placeholder.
     * Design Pattern : Decorator / Accessor
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image && file_exists(storage_path('app/public/' . $this->image))) {
            return asset('storage/' . $this->image);
        }

        // Placeholder selon la catégorie (Pattern Strategy)
        $placeholders = [
            'Bière' => 'https://placehold.co/200x200/1b2a3d/f0a500?text=🍺',
            'Vin'   => 'https://placehold.co/200x200/1b2a3d/f0a500?text=🍷',
            'Jus'   => 'https://placehold.co/200x200/1b2a3d/f0a500?text=🥤',
            'Eau'   => 'https://placehold.co/200x200/1b2a3d/f0a500?text=💧',
        ];

        return $placeholders[$this->categorie]
            ?? 'https://placehold.co/200x200/1b2a3d/f0a500?text=🍾';
    }

    /**
     * Relation : une boisson a plusieurs ventes.
     * Design Pattern : Active Record / Relation Eloquent
     */
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
