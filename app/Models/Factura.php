<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblfactura extends Model
{
    protected $table = 'tblfactura';
    protected $primaryKey = 'FacturaId';

    protected $fillable = [
        'PedidoId', 'monto_total', 'fecha_emision'
    ];

    public function pedido()
    {
        return $this->belongsTo(tblpedido::class, 'PedidoId');
    }
}

