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
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'date' => $this->created_at,
            'image' => $this->cover_image,
        ];
    }

    //Create a fonction to return more info
    /*
    public function with($request) {
        return  [
            'version' => '1.0.0',
            'author' => 'Alexandre Antippas',
        ];
    }
    */
}
