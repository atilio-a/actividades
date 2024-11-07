<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionType extends Model
{ 
    protected $table = 'actions_types';
    protected $fillable = [
        'nombre',
        'descripcion'

    ];
}
