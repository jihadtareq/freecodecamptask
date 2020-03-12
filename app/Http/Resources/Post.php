<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Post extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id'->$this->id,
            'user_id'->$this->user_id,
            'caption'->$this->caption,
            'image'->$this->image,
            'created_at'->$this->created_at,
            'updated_at'->$this->updated_at,
            

        ];
    }
}
