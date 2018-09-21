<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
	// PUBLIC MEMBERS
	public $timestamps = false;
	
	// PROTECTED MEMBERS
    protected $primaryKey = 'id';
    protected $table      = 'carts';
    protected $fillable   = array(
	    'user_session_id',
		'session_id',
		'product_id',
		'quantity'
    );
}
