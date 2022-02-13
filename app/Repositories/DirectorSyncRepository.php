<?php

namespace App\Repositories;

use App\Models\Director;
use tthdvd\Tmdb\Services\TMDBService;

class DirectorSyncRepository
{
    private $tmdb;

    public function __construct()
    {
        $this->tmdb = new TMDBService();
    }

    public function syncDirectors(): bool
    {
        $directors = Director::all();

        foreach ($directors as $director) {
            try {
                $response = $this->tmdb->getPerson($director->tmdb_id);
            } catch (\Exception $exception) {
                \Log::error($exception->getMessage());
                return false;
            }

            $director->name = $response->get('name');
            $director->biography = $response->get('biography');
            $director->date_of_birth = $response->get('birthday');

            $director->save();
        }

        return true;
    }
}
