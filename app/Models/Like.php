<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function likeable()
    {
    	return $this->morphTo();
    }
}