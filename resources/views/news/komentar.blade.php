@extends('layouts.master')
@section('content')

<div class="container" style="margin-top: 20px;">
    <form action="/komentar-post" method="POST">
    @csrf
    <div class="card">
        <div class="card-header">
            <a href="/news" class="btn btn-light btn-sm" style="float: left;">Back To List</a>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input name="judul" type="text" id="judul" class="form-control" value="{{$news->judul}}" autocomplete="off" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Penulis</label>
                <input name="penulis" type="text" id="penulis" class="form-control" value="{{$news->penulis}}" autocomplete="off" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Konten</label>
                <textarea name="konten" rows="5" cols="5" id="my-editor" class="form-control" placeholder="" readonly>{!! $news->konten !!}</textarea>
            </div>
        
        </div>
    </div>
    </br>
    <div class="card">
        <div class="card-header">
            <span>Komentar</span>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <textarea name="konten" rows="5" cols="5" class="form-control" placeholder=""></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Kirim</button>
        </div>
    </div>
    </form>
</div>

@endsection

@section('footer')
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('my-editor');
    CKEDITOR.config.autoParagraph = false;
    CKEDITOR.config.fillEmptyBlocks = false;
    CKEDITOR.config.removePlugins = 'elementspath';
</script>
@stop