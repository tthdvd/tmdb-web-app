<?php

namespace App\Http\Controllers;

use App\Services\MovieService;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    private MovieService $service;

    public function __construct()
    {
        $this->service = new MovieService();
    }

    public function list(Request $request)
    {
        return $this->service->list();
    }
}
