<?php

namespace App\Repositories;

use App\Models\Movie;

class MovieRepository
{

    public function list(): Movie|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
    {
        return Movie::query()->orderBy('order');
    }
}
