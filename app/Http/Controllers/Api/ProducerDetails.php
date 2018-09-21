<?php

namespace App\Http\Controllers\Api;

use App\ProducerDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;

class ProducerDetails extends Controller
{
	public function __construct()
	{
	}
	
	public function find($name = null)
	{
		if ($name == null)
		{
			$details = ProducerDetail::select(
				'name',
				'name_jpn',
				'short_name',
				'short_name_jpn',
				'country',
				'region',
				'region_jpn',
				'district',
				'district_jpn',
				'village',
				'village_jpn',
				'home_page',
				'founded_year',
				'headquarter',
				'headquarter_jpn',
				'family_head',
				'family_head_jpn',
				'field_area',
				'importer',
				'history_detail',
				'field_detail',
				'fermentation_detail',
				'original_contents',
				'is_original',
				'is_multi'
				)
				->orderBy('name', 'asc')
				->get();
		}
		else
		{
			$details = ProducerDetail::select(
				'name',
				'name_jpn',
				'short_name',
				'short_name_jpn',
				'country',
				'region',
				'region_jpn',
				'district',
				'district_jpn',
				'village',
				'village_jpn',
				'home_page',
				'founded_year',
				'headquarter',
				'headquarter_jpn',
				'family_head',
				'family_head_jpn',
				'field_area',
				'importer',
				'history_detail',
				'field_detail',
				'fermentation_detail',
				'original_contents',
				'is_original',
				'is_multi'
				)
				->where('name', '=', $name)
				->get();
		}
		
		return Response::json(array(
			'error'       => false,
			'details'     => $details,
			'status_code' => 200
		));
	}

    public function region($region)
	{
		$initial = Input::get('initial');
		if ($initial == null)
		{
			$producers = ProducerDetail::select('name', 'name_jpn', 'short_name', 'country', 'region', 'district', 'village')
				->where('region', '=', $region)
				->orderBy('name', 'asc')
				->get();
		}
		else
		{
			$producers = ProducerDetail::select('name', 'name_jpn', 'short_name', 'country', 'region', 'district', 'village')
				->where('region', '=', $region)		
				->where(function($query)
				{
					return $query
						->orwhere('name', 'like', 'Weingut ' . Input::get('initial') . '%')
						->orWhere('name', 'like', 'Bodegas ' . Input::get('initial') . '%')
						->orWhere('name', 'like', 'Domaine du ' . Input::get('initial') . '%')
						->orWhere('name', 'like', 'Domaine des ' . Input::get('initial') . '%')
						->orWhere('name', 'like', 'Domaine de la ' . Input::get('initial') . '%')
						->orWhere(function($query)
						{
							return $query
								->where('name', 'like', 'Domaine de ' . Input::get('initial') . '%')
								->where('name', 'not like', 'Domaine de la %');
						})
						->orWhere(function($query)
						{
							return $query
								->where('name', 'like', 'Domaine ' . Input::get('initial') . '%')
								->where('name', 'not like', 'Domaine de %')
								->where('name', 'not like', 'Domaine du %')
								->where('name', 'not like', 'Domaine des %');
						})
						->orWhere('name', 'like', 'Château la ' . Input::get('initial') . '%')
						->orWhere('name', 'like', 'Château de la ' . Input::get('initial') . '%')
						->orWhere(function($query)
						{
							return $query
								->where('name', 'like', 'Château de ' . Input::get('initial') . '%')
								->where('name', 'not like', 'Château de la%');
						})
						->orWhere(function($query)
						{
							return $query
								->where('name', 'like', 'Château ' . Input::get('initial') . '%')
								->where('name', 'not like', 'Château de %')
								->where('name', 'not like', 'Château la %');
						})
						->orWhere(function($query)
						{
							return $query
								->where('name', 'like', Input::get('initial') . '%')
								->where('name', 'not like', 'Weingut%')
								->where('name', 'not like', 'Domaine%')
								->where('name', 'not like', 'Bodegas%')
								->where('name', 'not like', 'Château%');
						});	              		
				})
				->orderBy('name', 'asc')
				->get();
		}
		
		return Response::json(array(
			'error'       => false,
			'producers'   => $producers,
			'status_code' => 200
		));
	}
	
	public function delete($name)
	{
		ProducerDetail::where('name', $name)
		->limit(1)
		->delete();
	}
}