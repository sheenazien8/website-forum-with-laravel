<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Quote extends Model
{
    use LikesTrait;
	protected $guarded = [];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(QuoteComment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function isOwner()
    {
    	if (Auth::guest()) {
    		return false;
    	}
        return Auth::user()->id == $this->user->id;
    }
}
