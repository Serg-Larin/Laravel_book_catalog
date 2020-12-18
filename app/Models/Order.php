<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App\Models
 * @property int $id
 * @property int $book_id
 * @property string $phone
 * @property string $name
 * @property bool status
 * @property string $email
 *
 */
class Order extends Model
{
    public const STATUS_PROCESSED = true;
    public const STATUS_UNFINISHED = false;

    use HasFactory;

    /**
     * @param int $book_id
     * @param string $email
     *
     * @return bool
     */
    public static function createNew($book_id,$email,$phone,$name){
        $newOrder = new self();
        $newOrder->book_id = $book_id;
        $newOrder->email = $email;
        $newOrder->name = $name;
        $newOrder->phone = $phone;
        $newOrder->status = self::STATUS_UNFINISHED;
        return $newOrder->save();
    }

    public function book(){
        return $this->belongsTo(Book::class);
    }
}
