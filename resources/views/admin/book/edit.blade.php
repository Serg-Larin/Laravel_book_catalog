@extends('admin.layout')
@section('content')

    <h1>Book</h1>
    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            {{$errors->first()}}
        </div>
    @endif
    <div class="col-8">
        <form method="post" action="{{route('book.update',['book'=>$book->id])}}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" value="{{$book->title}}" class="form-control" id="title">
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <select class="form-control" name="author_id" id="author">
                    @foreach($authors as $author)
                    <option value="{{$author->id}}"
                    @if($author->id == $book->author_id)
                        selected
                        @endif>
                        {{$author->name.' '.$author->surname}}
                    </option>
                    @endforeach
                </select>
            </div>
                <img src="{{$book->getImage()}}"
                     width="250" height="300"
                     style="border-radius: 5px;"
                     class="img-fluid" alt="Responsive image">
            <div class="form-group">
                <label for="image">Картинка</label>
                <input type="file" class="form-control-file" name="image" id="image">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3">{{$book->description}}</textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
