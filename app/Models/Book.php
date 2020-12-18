<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Book
 * @package App\Models
 * @property string $title
 * @property string $description
 * @property int $author_id
 * @property string $image
 *
 */
class Book extends Model
{
    use HasFactory;

   public function author(){
       return $this->belongsTo(Author::class);
   }


   public function getImage(){
        if($this->image == 'default'){
            return url('storage/images/default.jpeg');
        } else {
            return url('storage/'.$this->image);
        }
   }


   public function isOrdered(){
       $order =  Order::where('book_id',$this->id)->where('status',Order::STATUS_UNFINISHED)->first();
       return $order ? true : false;
   }

   public function comments(){
       return $this->hasMany(Comment::class,'book_id','id');
   }

}
