<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Category as CategoryResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if($this->type == "User"){    
            return [
                'id' => $this->id,
                'type' => $this->type,
                'username' => $this->username,
                'name' => ucwords($this->name),
                'email' => $this->email,
                'display' => $this->display,
                'phone_no' => $this->phone_no,
                'about' => $this->profile->about,
                'dob' => $this->profile->dob->format('Y-m-d'),
                'gender' => $this->profile->gender,
                'fcm_token' => $this->fcm_token,
            ];
        }
        elseif($this->type == "Company") {
            return [
                'id' => $this->id,
                'type' => $this->type,
                'username' => $this->username,
                'name' => ucwords($this->name),
                'email' => $this->email,
                'display' => $this->display,
                'description' => $this->company->description,
                'address' => $this->company->address,
                'fcm_token' => $this->fcm_token,
            ];
        }
        else{
            return [
                'id' => $this->id,
                'username' => $this->username,
                'name' => ucwords($this->name),
                'email' => $this->email,
                'display' => $this->display,
                'fcm_token' => $this->fcm_token,
            ];                        
        }
    }
}
