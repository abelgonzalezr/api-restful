<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait Paginates
{
    public function applyPagination(Request $request, $query)
    {
        $perPage = $request->input('per_page', 15); // 15 por defecto
        return $query->paginate($perPage);
    }
}