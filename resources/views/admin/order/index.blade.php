@extends('admin.layout')
@section('content')
        <h1>Orders</h1>
        @if(session()->has('success'))
            <div class="alert alert-success" role="alert">
                <h2>The order has been processed</h2>
            </div>
        @endif
        <ul class="nav nav-tabs" id="Tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active"
                   id="home-tab" data-toggle="tab"
                   href="#newOrder" role="tab"
                   aria-selected="true">
                    New Orders
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab"
                   data-toggle="tab" href="#history"
                   role="tab"
                   aria-selected="false">
                    History
                </a>
            </li>
        </ul>
        <div class="tab-content" id="TabContent">
            <div class="tab-pane fade show active" id="newOrder" role="tabpanel" aria-labelledby="home-tab">
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Email</th>
                            <th>Book title</th>
                            <th></th>
                            <th>Created_at</th>
                            <th>Updated_at</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)

                            @if($order->status == \App\Models\Order::STATUS_UNFINISHED)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->email}}</td>
                                <td>
                                    {{$order->book->title}}
                                </td>
                                <td>
                                    <b>
                                        <a class="btn btn-outline-success" href="{{route('order.one',['id'=> $order->id])}}">Look at</a>
                                    </b>
                                </td>
                                <td>{{$order->created_at}}</td>
                                <td>{{$order->updated_at}}</td>
                            </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="profile-tab">
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Email</th>
                            <th>Book title</th>
                            <th></th>
                            <th>Created_at</th>
                            <th>Updated_at</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            @if($order->status == \App\Models\Order::STATUS_PROCESSED)
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->email}}</td>
                                    <td>
                                        {{$order->book->title}}
                                    </td>
                                    <td>
                                        <b>
                                            <a class="btn btn-outline-success" href="{{route('order.one',['id'=> $order->id])}}">Look at</a>
                                        </b>
                                    </td>
                                    <td>{{$order->created_at}}</td>
                                    <td>{{$order->updated_at}}</td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

@endsection
