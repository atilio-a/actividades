<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionState extends Model
{ 
    protected $table = 'actions_states';
    protected $fillable = [
        'nombre',
        'descripcion'

    ];
}
