<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

trait LikesTrait
{
	public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function isLiked()
    {   
        if (Auth::check()) {
            return $this->likes->where('user_id',Auth::user()->id)->count();
        }
    }
}