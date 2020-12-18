@extends('admin.layout')
@section('content')

    <div class="col-8">
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                {{$errors->first()}}
            </div>
        @endif
    <form method="post" action="{{route('book.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="title">
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <select class="form-control" name="author_id" id="author">
                @foreach($authors as $author)
                <option value="{{$author->id}}">{{$author->name.' '.$author->surname}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="image">Картинка</label>
            <input type="file" class="form-control-file" name="image" id="image">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" rows="3">{{ old('description') }}</textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-primary">Create</button>
        </div>
    </form>
    </div>
@endsection
