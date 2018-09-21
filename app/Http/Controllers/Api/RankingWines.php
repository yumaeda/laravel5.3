<?php

namespace App\Http\Controllers\Api;

use DateTime;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class RankingWines extends Controller
{
    public function __construct()
    {
    }
    
    public function index()
    {
        $dayAfter = new DateTime();
        $dayAfter->modify('-2 weeks');

        $wines = DB::table('stock_records')
            ->join('wines', 'stock_records.barcode_number', '=', 'wines.barcode_number')
            ->limit(10)
            ->groupBy('wines.barcode_number')
            ->selectRaw('SUM(stock_records.quantity) as popularity, stock_records.barcode_number, ANY_VALUE(wines.producer) AS producer, ANY_VALUE(wines.producer_jpn) AS producer_jpn, ANY_VALUE(wines.price) AS price, ANY_VALUE(wines.member_price) AS member_price, ANY_VALUE(wines.vintage) AS vintage, ANY_VALUE(wines.combined_name_jpn) AS combined_name_jpn, ANY_VALUE(wines.combined_name) AS combined_name')
            ->where('stock_records.type', '=', '出庫')
            ->where('stock_records.stock_date', '>', $dayAfter->format('Y-m-d'))
            ->where('wines.availability', '=', 'Online')
            ->where('wines.type', '!=', 'Food')
            ->where('wines.type', '!=', 'Goods')
            ->where('wines.apply', '!=', 'DP')
            ->where('wines.stock', '>', 0)
            ->orderBy('popularity', 'desc')
            ->get();

        return Response::json(array(
            'error'       => false,
            'wines'       => $wines,
            'status_code' => 200
        ));
    }
}
