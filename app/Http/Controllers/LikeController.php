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
   public function like($type, $model_id)
   {
        $result = $this->checkType($type, $model_id);

        $model = $result[1];
        $model_type = $result[0];
        // nggak boleh ngelike comment atau quotes punya sendiri
        if (Auth::user()->id == $model->user->id) {
            die('ok');
        }
        // nggak boleh like berkali kali
        if ($model->isLiked() == null) {
            Like::create([
                'user_id' => Auth::user()->id,
                'likeable_id' => $model_id,
                'likeable_type' => $model_type
            ]);   
        }
   }

   public function unlike($type, $model_id)
   {
       $result = $this->checkType($type, $model_id);

       $model = $result[1];
       $model_type = $result[0];
       if ($model->isLiked()) {
           Like::where('user_id', Auth::user()->id)->where('likeable_id', $model_id)->where('likeable_type', $model_type)->delete(); 
       }
   }

   public function checkType($type, $model_id)
   {
        if ($type == 1) {
            $model_type = "App\Models\Quote";
            $model = Quote::find($model_id);
        }else {
            $model_type = "App\Models\QuoteComment";
            $model = QuoteComment::find($model_id);
        }

        return array($model_type, $model);
   }
}
