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

    public function destroy($id)
    {
        $comment = QuoteComment::find($id);
        if ($comment->isOwner()) {
            $comment->delete();
        }else {
            die('maaf anda tidak punya hak untuk mengedit kutipan ini');
        }

        return redirect()->back()->with('msg','sudah berhasil menghapus');
    }

    public function edit($id)
    {
        $comment = QuoteComment::find($id);
        if ($comment->isOwner()) {
            return view("quotes-comment.edit", compact('comment'));
        }else {
            die('maaf sayang sekali');
        }
    }
    public function update(Request $request, $id)
    {
        $comment = QuoteComment::find($id);
        if ($comment->isOwner()) {
            $comment->update([
                "comment" => $request->comment,
            ]);
        }else {
            die('maaf anda tidak punya hak untuk mengedit kutipan ini');
        }

        return redirect('/quotes/'. $comment->quote->slug)->with('msg','sudah berhasil update komentar');
    }
   
}
