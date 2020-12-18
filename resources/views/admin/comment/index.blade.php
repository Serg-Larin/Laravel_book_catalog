@extends('admin.layout')
@section('content')
    <h1>Comments</h1>
    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{session()->get('success')}}
        </div>
    @endif
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>Email</th>
                <th>Book title</th>
                <th>Comment text</th>
                <th></th>
                <th></th>
                <th>Created_at</th>
                <th>Updated_at</th>
            </tr>
            </thead>
            <tbody>
            @foreach($comments as $comment)
                <tr @if($comment->status == \App\Models\Comment::STATUS_APROOVED)
                    class="bg-success"
                    @endif>
                    <td>{{$comment->id}}</td>
                    <td>{{$comment->email}}</td>
                    <td>{{$comment->book->title}}</td>
                    <td>
                        <div  style="width: 20rem; ">
                            {{$comment->content}}
                        </div>
                    </td>
                    <td>
                        @if($comment->status != \App\Models\Comment::STATUS_APROOVED)
                        <form method="post" action="{{route('comment.approve',['id'=>$comment->id])}}">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-outline-success">Одобрить</button>
                        </form>
                        @endif
                    </td>
                    <td>
                        <form method="post" action="{{route('comment.delete',['id'=>$comment->id])}}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger">Удалить</button>
                        </form>
                    </td>
                    <td>{{$comment->created_at}}</td>
                    <td>{{$comment->updated_at}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
