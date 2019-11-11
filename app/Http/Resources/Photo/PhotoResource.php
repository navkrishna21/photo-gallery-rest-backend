<?php

namespace App\Http\Resources\Photo;

use Illuminate\Http\Resources\Json\JsonResource;

class PhotoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    return [

            'data'=> [
                
                "url" =>  $this->url? url('/images',$this->url) : null,
                
                "id"=> $this->id,
                
                "created_at"=> $this->created_at,
                
                "updated_at"=> $this->updated_at,
                
                "name"=>$this->name,
                
                "user_id"=> $this->user_id,

                "album_id"=> $this->album_id,

            ]
            
        ];
}
