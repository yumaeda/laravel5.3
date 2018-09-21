<?php

namespace App\Http\Controllers\Api;

use DateTime;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class NewWines extends Controller
{
    public function __construct()
    {
    }
    
    public function index()
    {
        $dayAfter = new DateTime();
        $dayAfter->modify('-1 month');

        $wines = DB::table('stock_records')
            ->join('wines', 'stock_records.barcode_number', '=', 'wines.barcode_number')          
            ->select('stock_records.barcode_number', 'wines.producer', 'wines.producer_jpn', 'wines.vintage', 'wines.combined_name_jpn', 'wines.combined_name')
            ->where('stock_records.type', '=', '入庫')
            ->where('stock_records.stock_date', '>', $dayAfter->format('Y-m-d'))
            ->where('wines.availability', '=', 'Online')
            ->where('wines.type', '!=', 'Food')
            ->where('wines.type', '!=', 'Goods')
            ->where('wines.apply', '!=', 'DP')
            ->where('wines.stock', '>', 0)
            ->orderBy('stock_records.stock_date', 'desc')
            ->get();

        return Response::json(array(
            'error'       => false,
            'wines'       => $wines,
            'status_code' => 200
        ));
    }
}
