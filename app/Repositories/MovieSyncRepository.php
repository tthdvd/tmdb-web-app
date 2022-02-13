<?php

namespace App\Repositories;

use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use tthdvd\Tmdb\Services\TMDBService;

class MovieSyncRepository
{

    private $tmdb;

    public function __construct()
    {
        $this->tmdb = new TMDBService();
    }

    public function syncGenre()
    {
        try {
            $response = $this->tmdb->getGenres();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return false;
        }

        foreach ($response->get('genres') as $genre) {
            Genre::updateOrCreate(['tmdb_id' => $genre->id], ['name' => $genre->name]);
        }

        return true;
    }

    public function syncMovies(int $amount): Collection
    {
        $count = 1;
        $pageCounter = 1;
        $enough = false;
        $movies = collect([]);

        while (!$enough) {

            try {
                $response = $this->tmdb->getTopMovies($pageCounter);
            } catch (\Exception $exception) {
                Log::error($exception);
                continue;
            }

            foreach ($response->get('results') as $movie) {
                $movies->push(Movie::updateOrCreate(
                    [
                        'tmdb_id' => $movie->id
                    ],
                    [
                        'title' => $movie->title,
                        'release_date' => $movie->release_date,
                        'overview' => $movie->overview,
                        'poster_path' => $movie->poster_path,
                        'poster_url' => Movie::generatePosterUrl($movie->poster_path),
                        'tmdb_vote_average' => $movie->vote_average,
                        'tmdb_vote_count' => $movie->vote_count,
                        'tmdb_url' => Movie::generateUrl($movie->id),
                        'order' => $count
                    ]
                ));

                if ($count === $amount) {
                    $enough = true;
                    break;
                }

                $count++;
            }

            $pageCounter++;
        }

        return $movies;
    }

    public function syncMovieDetails(): bool
    {
        $movies = Movie::all();

        foreach ($movies as $movie) {
            try {
                $movieDetails = $this->tmdb->getDetails($movie->tmdb_id, ['append_to_response' => 'credits']);
            } catch (\Exception $exception) {
                Log::error($exception->getMessage());
                return false;
            }
            $this->saveGenre($movie, $movieDetails);
            $this->saveDirectors($movie, $movieDetails);
        }

        return true;
    }

    private function saveDirectors(Movie $movie, Collection $movieDetails): bool
    {
        $credits = $movieDetails->get('credits');

        if (!$credits) {
            return false;
        }

        $crew = collect($credits->crew);
        $directors = $crew->where('job', 'Director');

        foreach ($directors as $directorResponse) {
            $director = Director::firstOrNew(
                [
                    'tmdb_id' => $directorResponse->id
                ],
                [
                    'name' => $directorResponse->name,
                ]
            );

            $movie->directors()->save($director);
        }

        return true;
    }

    private function saveGenre(Movie $movie, Collection $movieDetails): bool
    {
        $genres = $movieDetails->get('genres');

        if(!$genres) return false;

        foreach ($genres as $genreResponse) {

            $genre = Genre::firstOrNew(
                [
                    'tmdb_id' => $genreResponse->id
                ],
                [
                    'name' => $genreResponse->name
                ]
            );

            $movie->genres()->save($genre);
        }

        return true;
    }

}
