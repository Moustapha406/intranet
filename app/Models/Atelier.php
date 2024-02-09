<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atelier extends Model
{
    use HasFactory;


    protected $fillable = [
        'code',
        'libelle',
        'usine',
        'cadenceLigne',
        'cadenceJournaliere',
        'nbre_quart_default',
        'nbre_ligne',
        'nbre_heure',
        'TRGObjectif',
        'user_id'
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function productionJours()
    {
        return $this->hasMany(ProductionJour::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'ateliers_users', 'atelier_id', 'user_id');
    }
}
