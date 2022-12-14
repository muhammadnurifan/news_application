<?php

namespace App\Http\Controllers;

use App\Repositories\news\NewsRepository;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    protected $news;

    public function __construct(NewsRepository $news)
    {
        $this->news = $news;
    }

    public function index()
    {
        $news = News::paginate(10);
        return view('news.index', compact('news'));
    }

    public function create()
    {
        return view('news.create');
    }

    public function store(Request $request)
    {
        $news = $this->news->store($request);

        if (empty($news)) {
            return view('news.index')->with('error', 'error, please try again');
        }

        activity()
                ->causedBy(Auth::user())
                ->performedOn($news)
                ->log('Create');

        return redirect('/news')->with('sukses','Data inputted successfully');
    }

    public function show(News $news)
    {
        //
    }

    public function edit($id)
    {
        $news = $this->news->edit($id);

        $activity_logs = Activity::where('subject_id',$news->id)
                                ->where('subject_type','App\Models\News')
                                ->get();

        return view('news.edit', compact('news', 'activity_logs'));
    }

    public function post_komentar(Request $request, $news)
    {
        $news = $this->news->post_komentar($request, $news);

        return back();
    }

    public function komentar($id)
    {
        $news = $this->news->komentar($id);

        return view('news.komentar', compact('news'));
    }

    public function update(Request $request, $id)
    {
        $news = $this->news->update($request, $id);

        activity()
                ->causedBy(Auth::user())
                ->performedOn($news)
                ->log('Update');

        return redirect('/news')->with('sukses','Data updated successfully');
    }

    public function destroy($id)
    {
        $news = $this->news->destroy($id);

        return redirect('/news')->with('sukses','Data deleted successfully');
    }

    // API
    public function get_news_list()
    {
        $news = News::paginate(10);
        return response()->json($news);
    }

    public function post_news(Request $request)
    {
        $news = $this->news->store($request);

        activity()
                ->causedBy(Auth::user())
                ->performedOn($news)
                ->log('Create');

        return response()->json($news);
    }

    public function detail_news($id)
    {
        $news = $this->news->edit($id);

        return response()->json($news);
    }

    public function update_news(Request $request, $id)
    {
        $news = $this->news->update($request, $id);

        activity()
                ->causedBy(Auth::user())
                ->performedOn($news)
                ->log('Update');

        return response()->json($news);
    }

    public function destroy_news($id)
    {
        $news = $this->news->destroy($id);

        return response()->json("Data berhasil di hapus");
    }
}
