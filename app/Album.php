<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    //
    protected $fillable = ['name','user_id',"cover_photo",];

    public function user()
    {
      return $this->belongsTo(User::class,'user_id');
    }

    public function photos()
    {
      return $this->hasMany(Photo::class);
    }

}
