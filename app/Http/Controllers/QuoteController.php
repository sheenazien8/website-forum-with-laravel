<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tags = Tag::all();
        $requestSearch = urlencode($request->input('search'));
        if (!empty($requestSearch)) {
            $quotes = Quote::with('tags')->where('title', 'like', '%'.$requestSearch.'%')->get();
        }else {
            $quotes = Quote::with('tags')->get();
        }
        return view('quotes.index',compact('quotes', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('quotes.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
                "title" => "required|min:3",
                "content" => "required|min:5"
        ]);
//        $request->tags = array_diff($request->tags, [0]);
//        if (empty($request->tags)) {
//            return redirect()->back()->with('tag_error', 'tag nggak boleh kosong');
//        }
        $slug = str_slug($request->title,"-");

        if (Quote::where('slug', $slug)->first() != null) {
            $slug = $slug . "-".time();
        }

        $quote = Quote::create([
            "title" => $request->title,
            "slug" => $slug,
            "content" => $request->content,
            "user_id" => Auth::user()->id
        ]);
        
        $quote->tags()->attach($request->tags);
        
        return redirect('forum')->with('flash_notification',[
            'level' => 'success',
            'message' => 'Berhasil menyimpan nama penulis dengan nama ' . $request->title,
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  string slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $quote = Quote::with('comments.user','comments.likes')->where('slug', $slug)->first();

        if (empty($quote)) {
            // die('mati');
            abort("404");
        }
        return view("quotes.show", compact('quote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quote = Quote::find($id);
        $tags = Tag::all();
        // dd($tags);
        if ($quote->isOwner()) {
            return view("quotes.edit", compact('quote', 'tags'));
        }else {
            die('maaf sayang sekali');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $quote = Quote::find($id);
        $this->validate($request, [
                "title" => "required|min:3",
                "content" => "required|min:5"
        ]);
        $request->tags = array_diff($request->tags, [0]);
        if (empty($request->tags)) {
            return redirect()->back()->with('tag_error', 'tag nggak boleh kosong');
        }
        if ($quote->isOwner()) {
            $quote->update([
                "title" => $request->title,
                "content" => $request->content,
            ]);
        }else {
            die('maaf anda tidak punya hak untuk mengedit kutipan ini');
        }

        $quote->tags()->sync($request->tags);
        return redirect('forum')->with('msg','sudah berhasil update kutipan dengan judul yang baru yaitu ' . $request->title);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quote = Quote::find($id);
        if ($quote->isOwner()) {
            $quote->delete();
        }else {
            die('maaf anda tidak punya hak untuk mengedit kutipan ini');
        }

        return redirect('forum')->with('msg','sudah berhasil menghapus');
    }

    public function random()
    {
        $quote = Quote::inRandomOrder()->first();
        return view("quotes.show", compact('quote'));
    }

    public function filtag($tag)
    {
        $tags = Tag::all();
        $quotes = Quote::with('tags')->whereHas('tags',function($query) use ($tag)
        {
            $query->where('tag',$tag);
        })->get();
        return view('quotes.index', compact('quotes', 'tags'));
    }
}
