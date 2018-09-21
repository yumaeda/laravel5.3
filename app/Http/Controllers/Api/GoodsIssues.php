<?php

namespace App\Http\Controllers\Api;

use App\GoodsIssue;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class GoodsIssues extends Controller
{
	public function __construct()
	{
	}

	public function index()
	{
        $wines = DB::table('goods_issues')
	        ->join('wines', 'goods_issues.barcode_number', '=', 'wines.barcode_number')
		    ->select('wines.barcode_number', 'wines.vintage', 'wines.combined_name', 'wines.producer')
		    ->orderBy('goods_issues.date_delivered', 'asc')
            ->get();

	    return Response::json(array(
	        'error'       => false,
		    'wines'       => $wines,
		    'status_code' => 200
	    ));
	}

    public function store()
    {
	    $strResult = 'FAILED';
	
	    if (Input::has('barcode_number'))
	    {
            $wine = new GoodsIssue;
            $wine->barcode_number = Input::get('barcode_number');
            $wine->save();

            $strResult = 'SUCCESS';
	    }
	
	    return $strResult;
    }

    public function delete($id = null)
    {
	    if ($id == null)
	    {
            GoodsIssue::truncate();
	    }
	    else
	    {
            GoodsIssue::where('barcode_number', $id)
		        ->limit(1)
		        ->delete();
	    }
    }
}