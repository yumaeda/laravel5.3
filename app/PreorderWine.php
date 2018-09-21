<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class PreorderWine extends Model
{
	// PUBLIC MEMBERS
	public $timestamps = false;
	
	// PROTECTED MEMBERS
    protected $primaryKey = 'id';
    protected $table      = 'preorder_wines';
    protected $fillable   = array(
        'vintage',
		'combined_name',
		'producer',
		'capacity1',
		'stock',
		'price',
		'member_price',
		'point',
		'barcode_number'
    );
}