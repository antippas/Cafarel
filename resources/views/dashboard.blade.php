@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <br>
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">Dashboard</h1>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3 class="text-center">Liste de vos bars</h3>
                    <a href="http://localhost/lsapp/public/posts/create" class="btn btn-dark">Ajoutez un bar !</a>
                    <p></p>
                    @if(count($posts) > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">BAR</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        @foreach($posts as $post)
                            <tbody>
                                <tr>
                                <th scope="row">{{$post->title}}</th>
                                <td><a href="http://localhost/lsapp/public/posts/{{$post->id}}/edit" class="btn btn-success">Editer</a></td>
                                <td>
                                    {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class'=>'float-right'])!!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Supprimmer', ['class'=>'btn btn-danger'])}}
                                    {!!Form::close()!!}
                                </td>
                                </tr>            
                            @endforeach
                        </table>
                    @else
                        <p>Vous n'avez partagé aucun bar !</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
