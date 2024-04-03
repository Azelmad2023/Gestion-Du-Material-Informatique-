<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    use HasFactory;

    protected $primaryKey = 'codeCommune';
    protected $fillable = ['nomcommune_AR', 'nomCommune_FR', 'codeMilieu'];

    public function etablissements()
    {
        return $this->hasMany(Etablissement::class, 'codeCommune', 'codeCommune');
    }
}
