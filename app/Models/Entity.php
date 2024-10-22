<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    protected $table = 'entities';
    protected $fillable = [
        'nombre',
        'descripcion',
        'entity_id',
        'user_id',
        'telefono',
        'mail',
    ];

   // public $timestamps = false; // Deshabilita las marcas de tiempo
    
   public function entidad_padre()
   {
       return $this->belongsTo(Entity::class, 'entity_id');
   }

   // Relación con las entidades hijas
   public function entidades_hijas()
   {
       return $this->hasMany(Entity::class, 'entity_id');
   }
}
