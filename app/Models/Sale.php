<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'drink_id',
        'client_name',
        'quantite_vendue',
        'prix_total',
    ];

    public function drink()
    {
        return $this->belongsTo(Drink::class);
    }
}
