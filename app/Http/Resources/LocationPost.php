<?php

namespace App\Http\Resources;
use App\Http\Resources\Post as PostResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationPost extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'province' => $this->province,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'posts' => PostResource::collection($this->posts),
        ];
    }
}