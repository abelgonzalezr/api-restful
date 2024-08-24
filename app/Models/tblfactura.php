<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class tblfactura extends Model
{
    use HasFactory;

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
