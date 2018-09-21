<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Wine extends Model
{
	// PUBLIC MEMBERS
	public $timestamps = false;
	
	// PROTECTED MEMBERS
    protected $primaryKey = 'id';
    protected $table      = 'wines';
    protected $fillable   = array(
	    'barcode_number',
		'price',
		'member_price',
		'cepage',
		'rating',
		'rating_jpn',
		'cultivation_method',
		'stock',
		'importer',
		'producer',
		'producer_jpn',
		'vintage',
		'village',
		'village_jpn',
		'district',
		'district_jpn',
		'region',
		'region_jpn',
		'apply',
		'availability',
		'etc',
		'comment',
		'name',
		'name_jpn',
		'point',
		'catch_copy',
		'capacity1',
		'capacity2',
		'capacity3',
		'capacity4',
		'combined_name',
		'combined_name_jpn',
		'capacity'
    );
}
