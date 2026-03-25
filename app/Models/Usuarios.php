<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    //
    protected $fillable = ['nombre', 'apellido', 'materno', 'telefono', 'email', 'password', 'direccion'];

}
