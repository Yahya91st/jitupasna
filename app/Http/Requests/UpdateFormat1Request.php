<?php

namespace App\Http\Requests;

class UpdateFormat1Request extends StoreFormat1Request
{
    public function authorize(): bool
    {
        return true;
    }
}