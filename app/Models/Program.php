<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    
    protected $table = 'programs';
    protected $fillable = [
        'nombre',
        'descripcion',
        'entity_id'

    ];

    
    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }
}
