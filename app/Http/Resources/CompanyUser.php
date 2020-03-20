<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Category as CategoryResource;

class CompanyUser extends JsonResource
{
    private $CurrentUser;

    public function __construct($resource, $CurrentUser)
    {
        // Ensure to call the parent constructor
        parent::__construct($resource);
        $this->resource = $resource;
        
        $this->CurrentUser = $CurrentUser;
    }
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
            'type' => $this->type,
            'username' => $this->username,
            'name' => ucwords($this->name),
            'email' => $this->email,
            'display' => $this->display,
            'description' => $this->company->description,
            'address' => $this->company->address,
            'fcm_token' => $this->fcm_token,
            'current_user' => $this->CurrentUser,
        ];            
    }
}
