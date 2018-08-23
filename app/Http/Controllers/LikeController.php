<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
use App\Models\Like;


use Illuminate\Http\Request;

class LikeController extends Controller
{
   public function like($type, $modelId)
   {
        if ($type == 1) {
            $model = "App\Models\Quote";
        }else {
            $model = "App\Models\QuoteComment";
        }
        Like::create([
            'user_id' => Auth::user()->id,
            'likeable_id' => $modelId,
            'likeable_type' => $model
        ]);
   }
}
