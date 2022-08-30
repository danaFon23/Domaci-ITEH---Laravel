<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    
     public static $wrap = 'movie';
    
     public function toArray($request)
    {
        //return parent::toArray($request);
        
        return[
        'id'=>$this->resource->id,
        'title'=>$this->resource->title,
        'description'=>$this->resource->description,
        'year'=>$this->resource->year,
        'director'=>$this->resource->director,
        'genre'=>$this->resource->genre
        ];
    }
}
