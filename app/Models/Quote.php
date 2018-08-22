<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Quote extends Model
{
	protected $fillable = ['
		"title","slug","content","user_id"
	'];
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
