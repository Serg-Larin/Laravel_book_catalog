@extends('admin.layout')
@section('content')

    <h1>Books</h1>
    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            Changes have been saved
        </div>
    @endif
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="{{route('book.create')}}"><div class="btn btn-lg btn-outline-success"><b>Create NEW!</b></div></a>
            </div>
        </div>
    </div>
    <hr>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Author</th>
                <th></th>
                <th></th>
                <th>Created_at</th>
                <th>Updated_at</th>
            </tr>
            </thead>
            <tbody>
            @foreach($books as $book)
            <tr>
                <td>{{$book->id}}</td>
                <td>{{$book->title}}</td>
                <td>@isset($book->author->name){{$book->author->name}}@endisset</td>
                <td>
                    <b>
                        <a class="btn btn-outline-warning" href="{{route('book.edit',['book'=>$book->id])}}">Edit</a>
                    </b>
                </td>
                <td>
                    <form method="post" action="{{route('book.destroy',['book'=>$book->id])}}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger">Удалить</button>
                    </form>
                </td>
                <td>{{$book->created_at}}</td>
                <td>{{$book->updated_at}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
