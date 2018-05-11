@extends("layouts.app")

@section("content")
    <div class="jumbotron text-center">
        <h1>{{$title}}</h1>
        <img src="https://www.ruby-hotels.com/cache/images/rubymarie_bar-3_1cd0e8872f38e1c2571a13ec.jpg" style="width:100%">
        <p></p>
        <h2>Bienvenu sur l'application qui vous permet d'échanger vos bars favori.</h2>
        <br>
        <a class="btn btn-primary btn-lg" href="http://localhost/lsapp/public/login" role="button">Login</a>
        <a class="btn btn-success btn-lg" href="http://localhost/lsapp/public/register" role="button">Inscrivez-vous!</a>
    </div>
@endsection