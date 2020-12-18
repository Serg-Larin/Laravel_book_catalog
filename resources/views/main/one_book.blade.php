@extends('main.layout')
@section('content')
        <div class="text-center">
            <div>
                <a href="{{route('main.catalog')}}">
                    <div style="padding:30px 0 30px 0;">
                        <i class="fas fa-4x fa-arrow-alt-circle-left" style="color: #ffe817;"></i>
                    </div>
                </a>

            <div class="alert alert-success" style="display: none" id="success_message" role="alert">
                    <h2>Заказ отправлен в обработку</h2>
                </div>
            <div>
                <img class="img-thumbnail" style="width: 350px; height: 300px;" src="{{$book->getImage()}}" alt="">
            </div>
            <div style="margin-top:20px;">
                <h4>
                    {{$book->title}}
                </h4>
            </div>
            <div style="margin-top:20px;">
                <h5>
                    {{$book->author->name.' '.$book->author->surname}}
                </h5>
            </div>
            <div class="row">
                <div class="col-3">
                </div>
                <div class="col-6">
                    <span>
                        {{$book->description}}
                    </span>
                </div>
                <div class="col-3">
                </div>
            </div>

            {{--            @dd($book->order)--}}
            <div style="margin-top:50px">
                @if($book->isOrdered())
                    <div class="alert alert-danger" role="alert">
                        Книга не доступна к заказу
                    </div>
                @else
                    <button type="button"
                            class="btn btn-lg btn-warning"
                            id="order_button"
                            data-toggle="modal"
                            data-target="#modal"
                    >Заказать</button>
                @endif
            </div>
           </div>

    <div class="row" style="margin:20px 0 20px 0;">
        <div class="col-3"></div>
        <div class="col-4" style="border: 1px solid lightgray; border-radius: 5px; padding: 10px;">

                    <div class="alert alert-danger" id="danger_comment" style="display: none" role="alert">
                    </div>
                    <div class="alert alert-success" id="success_comment" style="display: none" role="alert">
                        Ваш комментарий отправлен в обработку.
                    </div>

                    @csrf
                    <div class="form-group">
                       <input type="text" name="email" class="form-control" id="comment_email" placeholder="example@mail.com">
                    </div>
                    <input type="text" name="book_id" value="{{$book->id}}" hidden>
                    <div class="form-group">
                        <textarea class="form-control" name="content" id="comment_content" rows="3"></textarea>
                    </div>
                    <button class="btn btn-warning" id="comment_button">Комментировать</button>
        </div>
        <div class="col-3"></div>
    </div>

   @foreach($comments as $comment)
    <div class="row" style="margin:20px 0 20px 0;">
            <div class="col-3"></div>
            <div class="col-6 confirmed_comments">
                <div class="card">
                    <div class="card-header text-left">
                       <b>
                           {{$comment->email}}
                       </b>
                    </div>
                    <div class="card-body text-right">
                        <blockquote class="blockquote text-left">
                            <small><p>{{$comment->content}}</p></small>
                        </blockquote>
                        <small>
                            <footer class="text-muted">{{$comment->created_at->format('Y F l H:i:s')}}</footer>
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-3"></div>
    </div>
            @endforeach





          <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">Форма заказа</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" style="display: none" id="danger_message" role="alert">
                        </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="email" placeholder="email" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">@example.com</span>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">+38</span>
                                </div>
                                <input type="text" class="form-control" id="phone" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">@</span>
                                </div>
                                <input type="text" class="form-control" id="name" placeholder="Имя" aria-describedby="basic-addon1">
                            </div>
                                <input type="text" id="book_id" value="{{$book->id}}" hidden>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="sendForm">Send</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>







        <script src="/js/app.js"></script>
        <script>
            $(document).ready(function () {
                let danger_message_modal = $('#danger_message');
                let success_comment = $('#success_comment');
                let danger_comment = $('#danger_comment');
                let comment_button =  $('#comment_button');
                $('#sendForm').on('click',function () {
                    $.ajax({
                        url: "{{route('order.new')}}",
                        method: 'POST',
                        data: {
                            '_token': '{{csrf_token()}}',
                            'book_id': $('#book_id').val(),
                            'email': $('#email').val(),
                            'name': $('#name').val(),
                            'phone': $('#phone').val(),
                        },
                        dataType: 'json'
                    }).done(function(result) {
                       if(typeof result['err']!=='undefined'){
                           danger_message_modal.text(result['err']);
                           danger_message_modal.css('display','block');
                       } else {
                           danger_message_modal.css('display','none');
                            $('#success_message').css('display','block');
                            $('#modal').modal('hide');
                            $('#order_button').attr('disabled',true);
                       }
                    })
                })
                comment_button.on('click',function () {
                    $.ajax({
                        url: "{{route('comment.new')}}",
                        method: 'POST',
                        data: {
                            '_token': '{{csrf_token()}}',
                            'book_id': $('#book_id').val(),
                            'content': $('#comment_content').val(),
                            'email': $('#comment_email').val()
                        },
                        dataType: 'json'
                    }).done(function(result) {
                        console.log(result);
                        if(typeof result['warning']!=='undefined'){
                            danger_comment.text(result['warning']);
                            danger_comment.css('display','block');
                        } else {
                            danger_comment.css('display','none');
                            success_comment.css('display','block');
                            comment_button.attr('disabled',true);
                        }
                    })
                })

            })
        </script>
@endsection
