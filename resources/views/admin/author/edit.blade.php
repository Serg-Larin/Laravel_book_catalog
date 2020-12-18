@extends('admin.layout')
@section('content')


    <div class="col-8">
        <h1>Author</h1>
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                {{$errors->first()}}
            </div>
        @endif
        <form action="{{route('author.update',['author'=>$author->id])}}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Name</label>
                <input type="text" name="name" value="{{$author->name}}" class="form-control" id="title">
            </div>
            <div class="form-group">
                <label for="title">Surname</label>
                <input type="text" name="surname" value="{{$author->surname}}" class="form-control" id="title">
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
