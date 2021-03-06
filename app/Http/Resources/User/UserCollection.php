<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\Resource;

class UserCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ['data' =>[
                'username' => $this->username,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'id' => $this->id,
                ]
        ];
    }
}
