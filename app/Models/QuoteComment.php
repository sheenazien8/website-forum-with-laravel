<?php

namespace App\Models;
use Auth;

use Illuminate\Database\Eloquent\Model;
class QuoteComment extends Model
{
	protected $guarded = [];
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function quote()
    {
    	return $this->belongsTo(Quote::class);
    }
    public function isOwner()
    {
    	if (Auth::guest()) {
    		return false;
    	}
        return Auth::user()->id == $this->user->id;
    }
}
