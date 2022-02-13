<?php

namespace App\Services;

use App\Repositories\MovieRepository;
use App\Repositories\MovieSyncRepository;
use Illuminate\Support\Collection;
use \Illuminate\Contracts\Pagination\LengthAwarePaginator;

class MovieService
{
    private MovieSyncRepository $movieSyncRepository;
    private MovieRepository $movieRepository;

    public function __construct()
    {
        $this->movieSyncRepository = new MovieSyncRepository();
        $this->movieRepository = new MovieRepository();
    }

    /**
     * @param int $amount
     * @return Collection
     */
    public function syncMovies(int $amount = 210): Collection
    {
        return $this->movieSyncRepository->syncMovies($amount);
    }

    /**
     * @return bool
     */
    public function syncMovieDetails(): bool
    {
        return $this->movieSyncRepository->syncMovieDetails();
    }

    /**
     * @return LengthAwarePaginator
     */
    public function list(): LengthAwarePaginator
    {
        return $this->movieRepository->list()->paginate();
    }
}
