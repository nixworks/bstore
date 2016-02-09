<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //

    protected $fillable = array('title', 'author');

    public function getTitle () {
        return $this->title;
    }

    public function getAuthor () {
        return $this->author;
    }
}
