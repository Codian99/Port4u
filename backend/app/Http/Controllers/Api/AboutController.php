<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class AboutController extends Controller
{
    /**
     * GET /about
     */
    public function index(): JsonResponse
    {
        return response()->json(config('portfolio.about'));
    }
}
