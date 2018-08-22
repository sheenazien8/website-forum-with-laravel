<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteComment extends Model
{
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function quote()
    {
    	return $this->belongsTo(Quote::class);
    }
}
