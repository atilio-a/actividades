<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    protected $table = 'localidades';
    protected $fillable = [
        'nombre',
        'departamento_id'
    ];

    public $timestamps = false; // Deshabilita las marcas de tiempo
    
    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }
}
