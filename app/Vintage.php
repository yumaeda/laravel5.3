<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Vintage extends Model
{
	// PUBLIC MEMBERS
	public $timestamps = false;
	
	// PROTECTED MEMBERS
    protected $primaryKey = 'id';
    protected $table      = 'vintages';
    protected $fillable   = array(
        'country',
        'region',
        'region_jpn',
		'district',
		'district_jpn',
		'vintage',
		'contents',
		'reference'
    );
}
