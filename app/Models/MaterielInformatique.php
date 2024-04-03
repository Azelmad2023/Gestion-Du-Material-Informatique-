<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterielInformatique extends Model
{
    use HasFactory;
    protected $fillable = ['Num_Inv', 'type', 'marque', 'dateDacquisition', 'EF', 'etat', 'codeGresa'];
    protected $primaryKey = 'Num_Inv'; // specify the primary key
    public $incrementing = false; // disable auto-incrementing
    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class, 'id', 'codeGresa');
    }
}
