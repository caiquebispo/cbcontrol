<?php

namespace App\Class\App;

use App\Http\Resources\NetworkResource;

class Network
{
    public function __construct(
        private ?object $user,
    ){}

    public function getAll()
    {
        return NetworkResource::collection($this->user->networks);
    }
}