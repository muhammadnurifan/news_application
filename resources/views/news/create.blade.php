@extends('layouts.master')
@section('content')

<div class="container" style="margin-top: 20px;">
    <form action="/news-post" method="POST">
    @csrf
    <div class="card">
        <div class="card-header">
            <button type="submit" class="btn btn-primary btn-sm" style="float: right;">Save</button>
            <a href="/news" class="btn btn-light btn-sm" style="float: left;">Back To List</a>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input name="judul" type="text" id="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul')}}" autocomplete="off">
                @error('judul')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Penulis</label>
                <input name="penulis" type="text" id="penulis" class="form-control @error('penulis') is-invalid @enderror" value="{{ old('penulis')}}" autocomplete="off">
                @error('penulis')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Konten</label>
                <textarea name="konten" rows="5" cols="5" onKeyPress id="my-editor" class="form-control @error('konten') is-invalid @enderror" value="" placeholder="">{{ old('konten') }}</textarea>
                @error('konten')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        
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