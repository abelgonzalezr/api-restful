<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblcliente extends Model
{
    protected $table = 'tblcliente';

    protected $primaryKey = 'ClienteId';

    protected $fillable = ['nombre', 'telefono', 'tipo_cliente'];

    public function compras()
    {
        return $this->hasMany(TblCompra::class, 'ClienteId', 'ClienteId');
    }
}
