<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblarticulo extends Model
{
    protected $table = 'tblArticulo';

    protected $primaryKey = 'ArticuloId';

    protected $fillable = ['codigo_barras', 'descripcion', 'fabricante'];

    public function colocaciones()
    {
        return $this->hasMany(TblColocacion::class, 'ArticuloId', 'ArticuloId');
    }
}
