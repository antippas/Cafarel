@extends("layouts.app")

@section('content')
    <br>
    <a href="http://localhost/lsapp/public/posts" class="btn btn-dark">Retour</a>
    <h1>{{$post->title}}</h1>
    <div class="col-md-4 col-sm-4">
        <img style="width:100%" src="http://localhost/lsapp/public/storage/cover_images/{{$post->cover_image}}">
    </div>
    <br>
    <div>
        {{$post->body}}
    </div>
    <hr>
    <small>Posté le {{$post->created_at}} par {{$post->user->name}}</small>
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
            <a href="http://localhost/lsapp/public/posts/{{$post->id}}/edit" class="btn btn-success">Editer</a>

            {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class'=>'float-right'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Supprimer', ['class'=>'btn btn-danger'])}}
            {!!Form::close()!!}
        @endif    
    @endif
@endsection