<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
use App\Models\Like;
use App\Models\Quote;
use App\Models\QuoteComment;

use Illuminate\Http\Request;

class LikeController extends Controller
{
   public function like($type, $modelId)
   {
        if ($type == 1) {
            $model_type = "App\Models\Quote";
            $model = Quote::find($modelId);
        }else {
            $model_type = "App\Models\QuoteComment";
            $model = QuoteComment::find($modelId);
        }
        // nggak boleh ngelike comment atau quotes punya sendiri
        if (Auth::user()->id == $model->user->id) {
            die('ok');
        }
        // nggak boleh like berkali kali
        if ($model->isLiked() == null) {
            Like::create([
                'user_id' => Auth::user()->id,
                'likeable_id' => $modelId,
                'likeable_type' => $model_type
            ]);   
        }
   }
}
