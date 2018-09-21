<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class WineSet extends Model
{
    // PUBLIC MEMBERS
    public $timestamps = false;
	
    // PROTECTED MEMBERS
    protected $primaryKey = 'id';
    protected $table      = 'wine_sets';
    protected $fillable   = array(
        'name',
        'comment',
        'type',
        'set_price'
    );
}
