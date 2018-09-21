<?php

namespace App\Http\Controllers\Api;

use App\PreorderWine;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class PreorderWines extends Controller
{
    public function __construct()
    {
    }
    
    public function find($type = null)
    {
        $wines = array();

        if ($type == null)
        {
            $wines = PreorderWine::select('vintage', 'combined_name', 'producer', 'capacity1', 'stock', 'price', 'member_price', 'point', 'barcode_number')
                ->orderBy('type', 'asc')
                ->orderBy('vintage', 'asc')
                ->get();
        }
        else
        {
            $wines = PreorderWine::select('vintage', 'combined_name', 'producer', 'capacity1', 'stock', 'price', 'member_price', 'point', 'barcode_number')
                ->where('type', $type)
                ->orderBy('vintage', 'asc')
                ->get();
        }

	return Response::json(array(
            'error'       => false,
            'wines'       => $wines,
            'status_code' => 200
        ));
    }

    public function creationDate()
    {
        $objDate = DB::table('information_schema.tables')
            ->select('create_time')
            ->where('table_name', 'preorder_wines')
            ->first();

        return Response::json(array(
            'error'       => false,
            'date'        => $objDate,
            'status_code' => 200
        ));
    }
}
