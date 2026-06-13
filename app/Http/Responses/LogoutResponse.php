<?php

namespace App\Http\Responses;

use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\LogoutResponse;

class LogoutResponse implements LogoutResponse
{
    public function toResponse($request)
    {
        return redirect()->route('landing');
    }
}
