<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
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
