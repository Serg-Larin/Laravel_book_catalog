<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        $books = Book::all();
        return view('main.index',compact('books'));
    }
    public function main(){
        return view('main.main');
    }

    public function oneBook($id){
        $book = Book::find($id);
        if($book){
            $comments = Comment::where('status', Comment::STATUS_APROOVED)->where('book_id',$book->id)->latest()->get();
            return view('main.one_book', compact('book','comments'));
        }
    }
}
