@extends('main.layout')
@section('content')
    <section class="jumbotron text-center bg-warning">
        <a class="navbar-brand" href="{{route('main')}}">
            <h1 class="display-1" style="color: black;">
               Bookstore
            </h1>
        </a>
    </section>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">

                @foreach($books as $book)
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <a href="{{route('one.book',['id'=>$book->id])}}">
                            <img class="card-img-top" width="150" height="200" src="{{$book->getImage()}}" alt="Card image cap">
                        </a>
                        <div class="card-body text-center">
                            <p class="card-text">{{$book->title}}</p>
                            <p class="card-text">{{$book->author->name}}</p>
                            <div class="d-flex justify-content-center">
                                <div class="btn-group">
                                    <a href="{{route('one.book',['id'=>$book->id])}}"><div  class="btn btn-warning">Посмотреть</div></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
