@extends('layouts.app')

@section('content')
    <br>
    <h1>Partagez vos bars !</h1>
    <br>
    @if(count($posts) > 0)
        @foreach($posts as $post)
            <div class="card">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img style="width:100%" src="http://localhost/lsapp/public/storage/cover_images/{{$post->cover_image}}">
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <br>
                        <h3><a href="http://localhost/lsapp/public/posts/{{$post->id}}">{{$post->title}}</a></h3>
                        <p>{{$post->body}}</p>
                        <small>Posté le {{$post->created_at}} par {{$post->user->name}}</small>
                    </div>
                </div>
            </div>
            <br>
        @endforeach
        {{$posts->links()}}
    @else
        <p>Pas de bar :(</p>
    @endif
@endsection