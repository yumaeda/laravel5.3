<?php

namespace App\Http\Controllers\Api;

use App\WineSet;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class WineSets extends Controller
{
    public function __construct()
    {
    }
    
    public function find($id = null)
    {
        $wines = array();
        
        if ($id == null)
        {
            $type  = Input::get('type', 0);
            $wines = WineSet::select(
                    'id', 'name', 'comment', 'type', 'set_price',
                    DB::raw('(SELECT SUM(wines.price) FROM set_wines INNER JOIN wines ON set_wines.barcode_number=wines.barcode_number WHERE wine_sets.id=set_wines.set_id) AS price'),
                    DB::raw('(SELECT MIN(wines.stock) FROM set_wines INNER JOIN wines ON set_wines.barcode_number=wines.barcode_number WHERE wine_sets.id = set_wines.set_id) AS stock'))
                    ->where('type', '=', $type)
                    ->get();
        }
        else
        {
            $wines = WineSet::select(
                    'id', 'name', 'comment', 'type', 'set_price',
                    DB::raw('(SELECT SUM(wines.price) FROM set_wines INNER JOIN wines ON set_wines.barcode_number=wines.barcode_number WHERE wine_sets.id=set_wines.set_id) AS price'),
                    DB::raw('(SELECT MIN(wines.stock) FROM set_wines INNER JOIN wines ON set_wines.barcode_number=wines.barcode_number WHERE wine_sets.id = set_wines.set_id) AS stock'))
                    ->where('id', '=', $id)
                    ->get();
        }

        return Response::json(array(
                'error'       => false,
                'wines'       => $wines,
                'status_code' => 200
        ));
    }
}
