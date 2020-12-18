<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentCreateRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{

    public function index(){
        $comments = Comment::all();
        return view('admin.comment.index',compact('comments'));
    }

    public function delete($id){
        $comment = Comment::find($id);
        if($comment){
           $comment->delete();
        }
        return redirect()->back()->with('success','Comment has been deleted');
    }

    public function approve($id){
        $comment = Comment::find($id);
        if($comment){
            $comment->status = Comment::STATUS_APROOVED;
            $comment->save();
        }
        return redirect()->back()->with('success','Comment has been approved');
    }

    public function createNew(Request $request){
        $requestData = $request->all();
        $validate = Validator::make($requestData,[
            'email'=>['required','min:3','email',],
            'content'=>['required','min:3'],
            'book_id'=>['required','numeric','exists:books,id']
                ]
        );
        if(!$validate->fails()){
            return response()->json(['success'=>Comment::createNew(
                $requestData['email'],
                $requestData['content'],
                $requestData['book_id']
            )]);
        }
        return response()->json(['warning'=>$validate->getMessageBag()->first()]);
    }

}
