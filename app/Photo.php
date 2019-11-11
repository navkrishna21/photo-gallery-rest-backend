<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $fillable = ['name','album_id',"url"];

    public function user()
    {
      return $this->belongsTo(Album::class,'album_id');
    }
}
