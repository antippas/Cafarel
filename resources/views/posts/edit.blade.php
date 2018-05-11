@extends("layouts.app")

@section('content')
<br>
    <h1>Editer</h1>
    {!! Form::open(['action'=>['PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title','Titre')}}
            {{Form::text('title',$post->title, ['class'=>'form-control', 'placeholder'=>'Titre'])}}
        </div>
        <div class="form-group">
            {{Form::label('body','Corps')}}
            {{Form::textarea('body', $post->body,['id'=>'article-ckeditor', 'class'=>'form-control', 'placeholder'=>'Corps du texte'])}}
        </div>
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection