@extends('layouts.site')
@section('content')

<div id="top-kattiya" class="insta-wall" style="background: url('{{ url('/images/insta-wall-bg.png') }}')">
    <div class="container">
        <div class="row insta-tiles">
            @foreach(\App\Post::all() as $post)
            <div class="col-md-3 insta-tile" >
                <a target="_blank" href="{{$post->permalink}}">
                    <div style="background-image: url('{{ $post->media_url }}'); height: 260px; width: 100%; background-size: cover; background-position:center center ">
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
@section('scripts')
@endsection