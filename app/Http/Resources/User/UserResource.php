<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if($this->sex =="male"){
            $image = asset('images/avatars/male.png');
        }else{
            $image = asset('images/avatars/female.png');
        }
        return [
            'id' => $this->id,
            'avatar' => $image,
            'name' => $this->full_name,
            'email_verified_at' => $this->email_verified_at,
            'role' => $this->role->name,
            'is_activated' => $this->is_activated,
            'created_at' => $this->created_at,
        ];
    }
}