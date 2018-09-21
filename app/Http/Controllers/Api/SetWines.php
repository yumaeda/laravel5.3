<?php

namespace App\Http\Controllers\Api;

use App\SetWine;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class SetWines extends Controller
{
    public function __construct()
    {
    }

    public function find($id)
    {
        $wines = array();

        if ($id != null)
        {
            $wines = SetWine::select('barcode_number', 'comment')
            ->where('set_id', $id)
            ->get();
        }

        return Response::json(array(
            'error'       => false,
            'wines'       => $wines,
            'status_code' => 200
        ));
    }
}
