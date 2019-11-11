<?php

namespace App\Http\Resources\Album;

use Illuminate\Http\Resources\Json\JsonResource;

class AlbumResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [

            'data'=> [
                
                "cover_photo" =>  $this->cover_photo? url('/images',$this->cover_photo) : null,
                
                "id"=> $this->id,
                
                "created_at"=> $this->created_at,
                
                "updated_at"=> $this->updated_at,
                
                "name"=>$this->name,
                
                "user_id"=> $this->user_id
            ]
            
        ];
    }
}
