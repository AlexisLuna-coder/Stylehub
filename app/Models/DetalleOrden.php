<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleOrden extends Model
{
    protected $fillable = [
        'orden_id',
        'producto_id',
        'cantidad',
        'precio'
    ];

    public function orden()
    {
        return $this->belongsTo(Ordenes::class);
    }

    public function producto()
    {
        return $this->belongsTo(Productos::class);
    }
}
