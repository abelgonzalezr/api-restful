<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\tblcliente;
use App\Models\tblfactura;

class tblpedido extends Model
{
    use HasFactory;

    protected $table = 'tblpedido';
    protected $primaryKey = 'PedidoId';

    protected $fillable = [
        'ClienteId', 'fecha'
    ];

    public function cliente()
    {
        return $this->belongsTo(tblcliente::class, 'ClienteId', 'ClienteId');
    }

    public function facturas()
    {
        return $this->hasMany(tblfactura::class, 'PedidoId', 'PedidoId');
    }
}
