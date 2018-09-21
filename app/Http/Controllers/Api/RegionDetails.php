<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class RegionDetails extends Controller
{
    public function __construct()
    {
    }
	
    public function find($region)
    {
        $details = array();

        if ($region !== null)
        {
            $details = DB::table('html_pages')
                ->select('contents')
                ->where('region', $region)
                ->where('district', '')
                ->where('village', '')
                ->get();
        }

        return Response::json(array(
                'error'       => false,
                'details'     => $details,
                'status_code' => 200
        ));
    }
}
