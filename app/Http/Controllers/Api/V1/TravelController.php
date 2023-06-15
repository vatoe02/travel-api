<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Travel;
use Illuminate\Http\Request;
use App\Http\Resources\TravelResource;

class TravelController extends Controller
{
    public function index()
    {
        $travels = Travel::where('is_public',false)->paginate(16);

        return TravelResource::collection($travels);
    }
}
