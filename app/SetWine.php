<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class SetWine extends Model
{
	// PUBLIC MEMBERS
	public $timestamps = false;
	
	// PROTECTED MEMBERS
    protected $primaryKey = 'id';
    protected $table      = 'set_wines';
    protected $fillable   = array(
        'set_id',
        'barcode_number',
        'comment'
	);
}