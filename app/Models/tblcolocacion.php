<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblcolocacion extends Model
{
    protected $table = 'tblColocacion';

    protected $primaryKey = 'ColocacionId';

    protected $fillable = ['nombre', 'precio', 'ArticuloId'];

    public function articulo()
    {
        return $this->belongsTo(TblArticulo::class, 'ArticuloId', 'ArticuloId');
    }

    public function compras()
    {
        return $this->hasMany(TblCompra::class, 'ColocacionId', 'ColocacionId');
    }
}
