@extends('admin.layout')
@section('content')
    <div class="col-8">
        <h1>Author</h1>
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                {{$errors->first()}}
            </div>
        @endif
        <form action="{{route('author.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="title">Name</label>
                <input type="text" name="name" class="form-control" id="title">
            </div>
            <div class="form-group">
                <label for="title">Surname</label>
                <input type="text" name="surname" class="form-control" id="title">
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
@endsection
