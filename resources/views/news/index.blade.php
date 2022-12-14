@extends('layouts.master')
@section('content')

<div class="container" style="margin-top: 20px;">
    <div class="card">
    <div class="card-header">
        <a href="{{route('news.create')}}" class="btn btn-primary btn-sm" style="float: right;">New</a>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th style="width: 50px;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($news as $value)
                <tr>
                    <td>{{$value->judul}}</td>
                    <td>{{$value->penulis}}</td>
                    <td style="text-align: center;">
                        <div class="btn-group " role="group" data-placement="top" title="" data-original-title=".btn-xlg">
                            <a href="/news/{{$value->id}}/komentar" class="btn btn-info btn-sm">Komentar</a>
                            <a href="/news/{{$value->id}}/edit" class="btn btn-success btn-sm">Edit</a>
                            <a href="#" class="btn btn-danger btn-sm delete" value-id="{{$value->id}}" value-name="{{$value->judul}}">Delete</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $news->links('pagination::bootstrap-4') }}

    </div>
    </div>
</div>

@endsection

@section('footer')
<script>
    $(document).ready(function() {
        $('.delete').click(function(){
            var value_name = $(this).attr('value-name');
            var value_id = $(this).attr('value-id');
            swal({
            title: "Are you sure deleted data?",
            text: "With name "+value_name +" ??",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                window.location = "/news/"+value_id+"/delete";
            } 
            });
        });
    });
</script>
@stop