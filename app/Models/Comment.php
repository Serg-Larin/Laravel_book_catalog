<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public const STATUS_APROOVED = true;

    public function book(){
        return $this->belongsTo(Book::class);
    }

    public static function createNew($email,$content,$book_id){
        $comment = new self();
        $comment->email = $email;
        $comment->content = $content;
        $comment->book_id = $book_id;
        return $comment->save();
    }
}
