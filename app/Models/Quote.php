<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Quote extends Model
{
	protected $guarded = [];
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
