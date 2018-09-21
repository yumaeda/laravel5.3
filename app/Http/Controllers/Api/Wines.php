<?php

namespace App\Http\Controllers\Api;

use App\Wine;
use App\PreorderWine;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class Wines extends Controller
{
    public function __construct()
    {
    }

    public function importer()
    {
        $importers = Wine::select('importer')
            ->groupBy('importer')
            ->where('importer', '!=', 'TAKAHASHI COLLECTION')
            ->where('importer', '!=', 'MATSUYA SAKETEN')
            ->where('importer', '!=', 'KANAI-YA')						
            ->where('importer', '!=', 'ESPOA SHINKAWA')			
            ->where('importer', '!=', 'LA VINÉE')			
            ->where('importer', '!=', 'SENSHO')
            ->where('importer', '!=', 'TSUCHIURA SUZUKI-YA')
            ->where('importer', '!=', 'LA TOUR D\'ARGENT')	
            ->orderBy('importer', 'asc')
            ->get();

        return Response::json(array(
            'error'       => false,
            'importers'   => $importers,
            'status_code' => 200
        ));
    }

    public function find($id = null)
    {
        $wines = array();
    
        if ($id == null)
        {
            if (Input::has('importer'))
            {
                $wines = Wine::select('barcode_number', 'type', 'country', 'region', 'region_jpn', 'producer', 'producer_jpn', 'vintage', 'stock', 'availability', 'apply', 'etc', 'price', 'member_price', 'point', 'capacity', 'combined_name_jpn', 'combined_name')
                    ->where('availability', '=', 'Online')
                    ->where('apply', '!=', 'DP')
                    ->where('type', '!=', 'Goods')
                    ->where('importer', Input::get('importer'))
                    ->orderBy('price', 'asc')
                    ->get();
            }
            else if (Input::has('producer'))
            {
                $wines = Wine::select('barcode_number', 'type', 'country', 'region', 'region_jpn', 'producer', 'producer_jpn', 'vintage', 'stock', 'availability', 'apply', 'etc', 'price', 'member_price', 'point', 'capacity', 'combined_name_jpn', 'combined_name')
                    ->where('availability', '=', 'Online')
                    ->where('apply', '!=', 'DP')
                    ->where('type', '!=', 'Goods')
                    ->where('producer', Input::get('producer'))
                    ->orderBy('price', 'asc')
                    ->get();
            }
            else if (Input::has('country'))
            {
                $wines = Wine::select('barcode_number', 'type', 'country', 'region', 'region_jpn', 'producer', 'producer_jpn', 'vintage', 'stock', 'availability', 'apply', 'etc', 'price', 'member_price', 'point', 'capacity', 'combined_name_jpn', 'combined_name')
                ->where('availability', '=', 'Online')
                ->where('apply', '!=', 'DP')
                ->where('type', '!=', 'Goods')
                ->where('country', Input::get('country'))
                ->orderBy('price', 'asc')
                ->get();
            }
            else if (Input::has('region'))
            {
                $wines = Wine::select('barcode_number', 'type', 'country', 'region', 'region_jpn', 'producer', 'producer_jpn', 'vintage', 'stock', 'availability', 'apply', 'etc', 'price', 'member_price', 'point', 'capacity', 'combined_name_jpn', 'combined_name')
                    ->where('availability', '=', 'Online')
                    ->where('apply', '!=', 'DP')
                    ->where('type', '!=', 'Goods')
                    ->where('region', Input::get('region'))
                    ->orderBy('price', 'asc')
                    ->get();
            }
            else if (Input::has('district'))
            {
                $wines = Wine::select('barcode_number', 'type', 'country', 'region', 'region_jpn', 'producer', 'producer_jpn', 'vintage', 'stock', 'availability', 'apply', 'etc', 'price', 'member_price', 'point', 'capacity', 'combined_name_jpn', 'combined_name')
                    ->where('availability', '=', 'Online')
                    ->where('apply', '!=', 'DP')
                    ->where('type', '!=', 'Goods')
                    ->where('district', Input::get('district'))
                    ->orderBy('price', 'asc')
                    ->get();
            }
            else if (Input::has('village'))
            {
                $wines = Wine::select('barcode_number', 'type', 'country', 'region', 'region_jpn', 'producer', 'producer_jpn', 'vintage', 'stock', 'availability', 'apply', 'etc', 'price', 'member_price', 'point', 'capacity', 'combined_name_jpn', 'combined_name')
                    ->where('availability', '=', 'Online')
                    ->where('apply', '!=', 'DP')
                    ->where('type', '!=', 'Goods')
                    ->where('village', Input::get('village'))
                    ->orderBy('price', 'asc')
                    ->get();
            }            
            else if (Input::has('type'))
            {
                $wines = Wine::select('barcode_number', 'type', 'country', 'region', 'region_jpn', 'producer', 'producer_jpn', 'vintage', 'stock', 'availability', 'apply', 'etc', 'price', 'member_price', 'point', 'capacity', 'combined_name_jpn', 'combined_name')
                    ->where('availability', '=', 'Online')
                    ->where('apply', '!=', 'DP')
                    ->where('type', '!=', 'Goods')
                    ->where('type', Input::get('type'))
                    ->orderBy('price', 'asc')
                    ->get();
            }
            else if (Input::has('min-price') && Input::has('max-price'))
            {
                $wines = Wine::select('barcode_number', 'type', 'country', 'region', 'region_jpn', 'producer', 'producer_jpn', 'vintage', 'stock', 'availability', 'apply', 'etc', 'price', 'member_price', 'point', 'capacity', 'combined_name_jpn', 'combined_name')
                ->where('availability', '=', 'Online')
                ->where('apply', '!=', 'DP')
                ->where('type', '!=', 'Goods')
                ->where('price', '>=', Input::get('min-price'))
                ->where('price', '<=', Input::get('max-price'))				
                ->orderBy('price', 'asc')
                ->get();
            }
            else if (Input::has('year-range'))
            {
                $yearRange = Input::get('year-range');
                if (is_numeric($yearRange))
                {
                    $yearRange = intval($yearRange);

                    $wines = Wine::select('barcode_number', 'type', 'country', 'region', 'region_jpn', 'producer', 'producer_jpn', 'vintage', 'stock', 'availability', 'apply', 'etc', 'price', 'member_price', 'point', 'capacity', 'combined_name_jpn', 'combined_name')
                        ->where('availability', '=', 'Online')
                        ->where('apply', '!=', 'DP')
                        ->where('type', '!=', 'Goods')
                        ->where('vintage', '>=', $yearRange)
                        ->where('vintage', '<', ($yearRange + 10))
                        ->orderBy('vintage', 'asc')
                        ->orderBy('price', 'asc')
                        ->get();
                }
            }
            else if (Input::has('keyword'))
            {
                $wines = Wine::select('barcode_number', 'type', 'country', 'region', 'region_jpn', 'producer', 'producer_jpn', 'vintage', 'stock', 'availability', 'apply', 'etc', 'price', 'member_price', 'point', 'capacity', 'combined_name_jpn', 'combined_name')
                    ->where('availability', '=', 'Online')
                    ->where('apply', '!=', 'DP')
                    ->where('type', '!=', 'Goods')
                    ->where(function($query)
                    {
                        $keyword = Input::get('keyword');

                        return $query
                            ->orWhere('barcode_number', 'like', '%' . $keyword . '%')
                            ->orWhere('importer', 'like', '%' . $keyword . '%')
                            ->orWhere('cepage', 'like', '%' . $keyword . '%')
                            ->orWhere('producer', 'like', '%' . $keyword . '%')
                            ->orWhere('producer_jpn', 'like', '%' . $keyword . '%')
                            ->orWhere('country', 'like', '%' . $keyword . '%')
                            ->orWhere('region', 'like', '%' . $keyword . '%')
                            ->orWhere('region_jpn', 'like', '%' . $keyword . '%')
                            ->orWhere('district', 'like', '%' . $keyword . '%')
                            ->orWhere('district_jpn', 'like', '%' . $keyword . '%')
                            ->orWhere('combined_name', 'like', '%' . $keyword . '%')
                            ->orWhere('combined_name_jpn', 'like', '%' . $keyword . '%');
                    })	
                    ->orderBy('price', 'asc')
                    ->get();
            }
        }
        else
        {
            if ($id >= 100000)
            {
                $wines = PreorderWine::select('vintage', 'combined_name', 'producer', 'capacity1', 'stock', 'price', 'member_price', 'point', 'barcode_number')
                    ->where('barcode_number', $id)
                    ->get();
            }
            else
            {
                $wines = DB::table('wines')
                    ->leftJoin('wine_details', 'wines.barcode_number', '=', 'wine_details.barcode_number')
                    ->select('wines.barcode_number',
                        'wines.type',
                        'wines.country',
                        'wines.producer',
                        'wines.producer_jpn',
                        'wines.region',
                        'wines.region_jpn',
                        'wines.village',
                        'wines.village_jpn',
                        'wines.district',
                        'wines.district_jpn',
                        'wines.cepage',
                        'wines.vintage',
                        'wines.importer',
                        'wines.catch_copy',
                        'wines.comment',
                        'wines.stock',
                        'wines.apply',
                        'wines.availability',
                        'wines.etc',
                        'wines.price',
                        'wines.member_price',
                        'wines.point',
                        'wine_details.detail AS original_comment',
                        'wines.glass_price',
                        'wines.store_price AS restaurant_price',
                        'wines.capacity',
                        'wines.combined_name_jpn',
                        'wines.combined_name')
                    ->where('wines.barcode_number', $id)
                    ->get();
            }
        }

        return Response::json(array(
                'error'       => false,
                'wines'       => $wines,
                'status_code' => 200
        ));
    }

    public function detail($producer)
    {
        $details = DB::table('wines')
            ->leftJoin('wine_details', 'wines.barcode_number', '=', 'wine_details.barcode_number')
            ->select('wines.barcode_number', 'wines.producer', 'wine_details.detail')
            ->where('wines.producer', '=', $producer)
            ->where('wines.apply', '!=', 'DP')
            ->orderBy('wines.type', 'asc')
            ->orderBy('wines.price', 'asc')
            ->orderBy('wines.village', 'asc')
            ->orderBy('wines.rating', 'asc')
            ->orderBy('wines.name', 'asc')
            ->orderBy('wines.vintage', 'asc')
            ->get();

        return Response::json(array(
            'error'       => false,
            'details'     => $details,
            'status_code' => 200
        ));
    }

    public function getCounties($type = null)
    {
        if ($type == null)
        {
            $countries = Wine::select('country')
                ->groupBy('country')
                ->where('availability', '=', 'Online')
                ->where('country', '!=', '')
                ->orderBy('country', 'asc')
                ->get();
        }
        else
        {
            $countries = Wine::select('country')
                ->groupBy('country')
                ->where('type', $type)
                ->where('availability', '=', 'Online')
                ->where('country', '!=', '')
                ->orderBy('country', 'asc')
                ->get();
        }

        return Response::json(array(
            'error'       => false,
            'countries'   => $countries,
            'status_code' => 200
        ));
    }

    public function getDistricts($region = null, $type = null)
    {
        if ($region == null)
        {
            $districts = Wine::selectRaw('district, ANY_VALUE(district_jpn) AS district_jpn')
                ->groupBy('district')
                ->where('district', '!=', '')
                ->orderBy('district', 'asc')
                ->get();
        }
        else
        {
            if ($type == null)
            {
                $districts = Wine::selectRaw('district, ANY_VALUE(district_jpn) AS district_jpn')
                    ->groupBy('district')
                    ->where('region', $region)
                    ->where('district', '!=', '')
                    ->orderBy('district', 'asc')
                    ->get();
            }
            else
            {
                $districts = Wine::selectRaw('district, ANY_VALUE(district_jpn) AS district_jpn')
                    ->groupBy('district')
                    ->where('type', $type)
                    ->where('region', $region)
                    ->where('district', '!=', '')
                    ->orderBy('district', 'asc')
                    ->get();
            }
        }

        return Response::json(array(
            'error'       => false,
            'districts'   => $districts,
            'status_code' => 200
        ));
    }

    public function getRegions($country = null, $type = null)
    {
        if ($country == null)
        {
            $regions = Wine::selectRaw('region, ANY_VALUE(region_jpn) AS region_jpn')
                ->groupBy('region')
                ->where('region', '!=', '')
                ->orderBy('region', 'asc')
                ->get();
        }
        else
        {
            if ($type == null)
            {
                $regions = Wine::selectRaw('region, ANY_VALUE(region_jpn) AS region_jpn')
                    ->groupBy('region')
                    ->where('country', $country)
                    ->where('region', '!=', '')
                    ->orderBy('region', 'asc')
                    ->get();
            }
            else
            {
                $regions = Wine::selectRaw('region, ANY_VALUE(region_jpn) AS region_jpn')
                    ->groupBy('region')
                    ->where('type', $type)
                    ->where('country', $country)
                    ->where('region', '!=', '')
                    ->orderBy('region', 'asc')
                    ->get();
            }
        }

        return Response::json(array(
            'error'       => false,
            'regions'     => $regions,
            'status_code' => 200
        ));
    }

    public function getVillages($region, $type = null)
    {
        if ($type == null)
        {
            $villages = Wine::selectRaw('village, ANY_VALUE(village_jpn) AS village_jpn')
                ->groupBy('village')
                ->where('availability', '=', 'Online')
                ->where('region', $region)
                ->orWhere('district', $region)
                ->get();
        }
        else
        {
            $villages = Wine::selectRaw('village, ANY_VALUE(village_jpn) AS village_jpn')
                ->groupBy('village')
                ->where('type', $type)
                ->where('availability', '=', 'Online')
                ->where('region', $region)
                ->orWhere('district', $region)
                ->get();
        }

        return Response::json(array(
            'error'       => false,
            'villages'    => $villages,
            'status_code' => 200
        ));
    }
}
