<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorControllerRequest;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        $authors = Author::all();
        return view('admin.author.index',compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create()
    {
        return view('admin.author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return mixed
     */
    public function store(AuthorControllerRequest $request)
    {
            $newAuthorOrder = new Author();
            $newAuthorOrder->name = $request->get('name');
            $newAuthorOrder->surname = $request->get('surname');
            return redirect()->route('author.index')->with('success',$newAuthorOrder->save());
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return mixed
     */
    public function edit($id)
    {
        $author = Author::find($id);
        foreach ($author->books() as $book){
            dump($book);
        }
        return view('admin.author.edit',compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return mixed
     */
    public function update(AuthorControllerRequest $request, $id)
    {
            $author = Author::find($id);
            $author->name = $request->get('name');
            $author->surname = $request->get('surname');
            return redirect()->route('author.index')->with('success',$author->save());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return mixed
     */
    public function destroy($id)
    {
        $author = Author::find($id);
        if($author){
            $author->books()->delete();
            $author->delete();
        }
        return redirect()->back();
    }
}
