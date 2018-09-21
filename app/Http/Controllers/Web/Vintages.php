<?php

namespace App\Http\Controllers\Web;

use App\Vintage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Vintages extends Controller
{
	public function __construct()
	{
	}
	
	public function find($region, $vintage)
	{
		$rgobjVintage = Vintage::select('vintage')
		    ->where('region', $region)
			->orderBy('vintage', 'asc')
			->get();

		$objSelectedVintage = Vintage::select('contents', 'region_jpn', 'reference')
		    ->where('region', $region)
			->where('vintage', $vintage)
			->first();

        return view('vintages', array('region' => $region, 'vintage' => $vintage, 'objSelectedVintage' => $objSelectedVintage, 'rgobjVintage' => $rgobjVintage));
	}
}
