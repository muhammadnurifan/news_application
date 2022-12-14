<?php

namespace App\Repositories\news;

use App\Repositories\news\NewsInterface;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Komentar;
use Carbon\Carbon;
use Validator;


class NewsRepository implements NewsInterface
{
    public function store($request)
    {
        $request->validate([
            'judul'     => 'required|string|unique:news',
            'penulis'   => 'required',
            'konten'    => 'required',
        ]);

        $array = [
            'judul'       => $request->judul,
            'penulis'     => $request->penulis,
            'konten'      => $request->konten,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ];

        $news = News::create($array);

        return $news;
    }

    public function edit($id)
    {
        $news = News::find($id);

        return $news;
    }

    public function komentar($id)
    {
        $news = News::find($id);

        return $news;
    }

    public function post_komentar($request, $news)
    {
        $array = [
            'news_id'     => $news->id,
            'komentar'    => $request->komentar,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ];

        $news = Komentar::create($array);

        return $news;
    }

    public function update($request, $id)
    {
        $news = News::find($id);
        $news->judul = $request->input('judul');
        $news->penulis = $request->input('penulis');
        $news->konten = $request->input('konten');
        $news->save();
        // $items->update($request->all());
        // if($request->hasFile('image')){
        //     $request->file('image')->move('img/',$request->file('image')->getClientOriginalName());
        //     $items->image = $request->file('image')->getClientOriginalName();
        //     $items->save();
        // }
        
        return $news;
    }

    public function destroy($id)
    {
        $news = News::find($id);
        $news->delete('news');

        return $news;
    }
}
