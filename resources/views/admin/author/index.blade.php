@extends('admin.layout')
@section('content')
    <h1>Authors</h1>
    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            Changes have been saved
        </div>
    @endif
    @if(session()->has('warning'))
        <div class="alert alert-danger" role="alert">
            {{session()->get('warning')}}
        </div>
    @endif
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="{{route('author.create')}}"><div class="btn btn-lg btn-outline-success"><b>Create NEW!</b></div></a>
            </div>
        </div>
    </div>
    <hr>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Surname</th>
                <th></th>
                <th></th>
                <th>Created_at</th>
                <th>Updated_at</th>
            </tr>
            </thead>
            <tbody>
            @foreach($authors as $author)
            <tr>
                <td>{{$author->id}}</td>
                <td>{{$author->name}}</td>
                <td>{{$author->surname}}</td>
                <td>
                    <b>
                        <a class="btn btn-outline-warning" href="{{route('author.edit',['author'=>$author->id])}}">Edit</a>
                    </b>
                </td>
                <td>
                    <form method="post" action="{{route('author.destroy',['author'=>$author->id])}}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger">Удалить</button>
                    </form>
                </td>
                <td>{{$author->created_at}}</td>
                <td>{{$author->updated_at}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
