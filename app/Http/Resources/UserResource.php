<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

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
        return [
            'id' => $this->id,
            'fname' => $this->fname,
            'lname' => $this->lname,
            'email' => $this->email,
            'country' => Country::select('name', 'sortname', 'phonecode')->find($this->country),
            'state' => state::select('name')->find($this->state),
            'city' => $this->city,
            'zip' => $this->zip,
            'profile_path' => $this->profile_path,
            'interests' => explode(',,', $this->interest),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
