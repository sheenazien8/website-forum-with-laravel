<?php

namespace App\Http\Controllers;

use App\Models\QuoteComment;
use App\Models\Quote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request,$id)
    {
        $quote = Quote::find($id);
        $this->validate($request, [
            "comment" => "required|min:3"
        ]);

        $quotes = QuoteComment::create([
            "comment" => $request->comment,
            "quote_id" => $id,
            "user_id" => Auth::user()->id
        ]);
        return redirect('/quotes/'.$quote->slug)->with('msg','sudah berhasil komentar');
    }

   
}
