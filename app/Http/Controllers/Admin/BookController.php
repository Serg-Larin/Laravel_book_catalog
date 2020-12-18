<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookControllerRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return view
     */
    public function index()
    {
        $books = Book::all();
        return view('admin.book.index',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create()
    {
        $authors = Author::all();
        return view('admin.book.create',compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BookControllerRequest  $request
     * @return mixed
     */
    public function store(BookControllerRequest $request)
    {
        $requestData = $request->all();
            $image = 'default';
            $newBookOrder = new Book();
            $newBookOrder->title = $requestData['title'];
            $newBookOrder->description = $requestData['description'];
            $newBookOrder->author_id = $requestData['author_id'];
            if($request->hasFile('image')){
                $image = $request->file('image')->store('images','public');
            }
            $newBookOrder->image = $image;
            return redirect()->route('book.index')->with('success', $newBookOrder->save());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return mixed
     */
    public function edit($id)
    {
        $book = Book::find($id);
        $authors = Author::all();
        return view('admin.book.edit',compact('book','authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BookControllerRequest  $request
     * @param  int  $id
     * @return mixed|void
     */
    public function update(BookControllerRequest $request, $id)
    {
        $book = Book::find($id);
        if($book) {
                $image = $book->image;
                $book->title = $request->get('title');
                $book->description = $request->get('description');
                $book->author_id = $request->get('author_id');
                if ($request->hasFile('image')) {
                    $image = $request->file('image')->store('images', 'public');
                    if($image!=='default'){
                        Storage::disk('public')->delete($book->image);
                    }
                }
                $book->image = $image;
                return redirect()->route('book.index')->with('success', $book->save());
            }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return mixed
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        if($book){
            $book->comments()->delete();
            $book->delete();
        }
        return redirect()->route('book.index')->with('success', $book->save());
    }
}
