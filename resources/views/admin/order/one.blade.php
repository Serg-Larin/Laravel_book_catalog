@extends('admin.layout')
@section('content')
    <div class="row">
        <div class="col-4">
            <div class="card" style="width: 18rem;">
                <div class="card-header">
                    Заказчик
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">email:  {{$order->email}} </li>
                    <li class="list-group-item">book : {{$order->book->title}}</li>
                    <li class="list-group-item">name:  {{$order->name}} </li>
                    <li class="list-group-item">phone : {{$order->phone}}</li>

                    <li class="list-group-item">
                        @if($order->status == \App\Models\Order::STATUS_UNFINISHED)
                        <form action="{{route('order.update',['id'=>$order->id])}}" method="post">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-success">Закрыть заказ</button>
                        </form>
                            @else
                            <div class="alert alert-danger" role="alert">
                                Заказ закрыт
                            </div>
                            @endif
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-4">
            <img  class="img-thumbnail" style="width: 350px; height: 250px" src="{{$order->book->getImage()}}" alt="">
            <div style="margin-top:20px;">
                <h4>
                    {{$order->book->author->name.' '.$order->book->author->surname}}
                </h4>
            </div>
            <div>
                    <span>
                        {{$order->book->description}}
                    </span>
            </div>
        </div>
    </div>
@endsection
