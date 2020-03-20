<?php

namespace App\Http\Resources;
use App\Http\Resources\Location as LocationResource;
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
      if($this->type == 'Ad'){    
          return [
            'id' => $this->id,
            'user' => [
                'id' => $this->user->id,
                'name' => ucwords($this->user->name),
                'email' => $this->user->email,
                'display' => $this->user->display,
            ],
            'media' => $this->files,
            'title' => ucfirst($this->title),
            'cost' => $this->cost,
            'description' => $this->description,
            'date_from' => $this->date_from,
            'date_to' => $this->date_to,
            'bookings_count' => $this->bookings_count,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
          ];
      }
      else{
          return [
            'id' => $this->id,
            'user' => [
                'id' => $this->user->id,
                'name' => ucwords($this->user->name),
                'email' => $this->user->email,
                'display' => $this->user->display,
            ],
            'media' => $this->files,
            'title' => ucfirst($this->title),
            'description' => $this->description,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
          ];                        
        }
    }
}
