<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class ProducerDetail extends Model
{
	// PUBLIC MEMBERS
	public $timestamps = false;
	
	// PROTECTED MEMBERS
    protected $primaryKey = 'id';
    protected $table      = 'producers';
    protected $fillable   = array(
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
    );
}
