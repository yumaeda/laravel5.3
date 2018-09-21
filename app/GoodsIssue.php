<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class GoodsIssue extends Model
{
	// PUBLIC MEMBERS
	public $timestamps = false;
	
	// PROTECTED MEMBERS
    protected $primaryKey = 'id';
    protected $table      = 'goods_issues';
    protected $fillable   = array(
        'barcode_number',
        'date_delivered'
    );
}