@extends('layouts.master')
@section('content')

<div class="container" style="margin-top: 20px;">
    <form action="/news/{{$news->id}}/update" method="POST">
    @csrf
    <div class="card">
        <div class="card-header">
            <button type="submit" class="btn btn-primary btn-sm" style="float: right;">Update</button>
            <a href="/news" class="btn btn-light btn-sm" style="float: left;">Back To List</a>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input name="judul" type="text" id="judul" class="form-control" value="{{$news->judul}}" autocomplete="off">
            </div>
            <div class="mb-3">
                <label class="form-label">Penulis</label>
                <input name="penulis" type="text" id="penulis" class="form-control" value="{{$news->penulis}}" autocomplete="off">
            </div>
            <div class="mb-3">
                <label class="form-label">Konten</label>
                <textarea name="konten" rows="5" cols="5" id="my-editor" class="form-control" placeholder="">{!! $news->konten !!}</textarea>
            </div>
        
        </div>
    </div>
    </form>
    </br>
    <div class="card">
        <div class="card-header">
            <span>Komentar</span>
        </div>
        <div class="card-body">
            <table class="table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Komentar</th>
                </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
    </br>
    <div class="card">
        <div class="card-header">
            <span>Log</span>
        </div>
        <div class="card-body">
            <table class="table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Activity</th>
                    <th>Date</th>
                    <th>Hour</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($activity_logs as $activity_log)
                    <tr>
                        <td>{{$activity_log->causer->name}}</td>
                        <td>{{$activity_log->description}}</td>
                        <td>{{date('d-m-Y', strtotime($activity_log->created_at))}}</td>
                        <td>{{date('H:i:s', strtotime($activity_log->created_at))}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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