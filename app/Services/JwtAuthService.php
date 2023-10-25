<?php

namespace App\Service;

use App\Models\Table\CustomerTable;
use App\Service\AppService;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtAuthService
{

    public function claimsJwtById($user)
    {
        return JWTAuth::fromUser($user);
    }
}
