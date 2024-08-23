<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblcompra extends Model
{
    protected $table = 'tblCompra';

    protected $primaryKey = 'CompraId';

    protected $fillable = ['ClienteId', 'ColocacionId', 'cantidad'];

    public function cliente()
    {
        return $this->belongsTo(TblCliente::class, 'ClienteId', 'ClienteId');
    }

    public function colocacion()
    {
        return $this->belongsTo(TblColocacion::class, 'ColocacionId', 'ColocacionId');
    }
}
