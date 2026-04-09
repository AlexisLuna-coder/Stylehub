<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ordenes extends Model
{
    protected $fillable = [
        'user_id', #ID del usuario que realizó la orden
        'fecha', #Cuando se realizó la orden
        'total', #Costo total de la orden
        'estado', /*pendiente,pagado,enviado,entregado,cancelado*/
        'direccion_envio', #A donde se mandará (tomar de usuario)
        'metodo_pago', #Método de pago utilizado (tarjeta, PayPal, etc.) 
    ];

    public function detalles()
    {
        return $this->hasMany(DetalleOrden::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
