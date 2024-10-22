<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'teams';
    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'mail',
        'observaciones',
        'entity_id'

    ];

    
    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }
    public function entidad()
    {
        return $this->belongsTo(Entity::class, 'entity_id');
    }
}
