<?php

namespace tthdvd\Tmdb\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class TMDBService
{

    /**
     * @return string
     */
    private function basePath(): string
    {
        return config('tmdb.base_domain') . '/' . config('tmdb.version');
    }

    /**
     * @return string
     */
    private function topMoviesPath(): string
    {
        return $this->basePath() . '/movie/top_rated';
    }

    /**
     * @return string
     */
    private function genresPath(): string
    {
        return $this->basePath() . '/genre/movie/list';
    }

    /**
     * @param int $id
     * @return string
     */
    private function personPath(int $id): string
    {
        return $this->basePath() . '/person/' . $id;
    }

    private function detailsPath(int $id): string
    {
        return $this->basePath() . '/movie/'. $id;
    }

    /**
     * @param string $url
     * @param array $params
     * @return Collection
     * @throws \Illuminate\Http\Client\RequestException
     */
    private function getData(string $url, array $params = []): Collection
    {
        $params['api_key'] = config('tmdb.api_key');

        $response = Http::get(
            $url,
            $params
        );

        if (!$response->successful()) {
            throw $response->toException();
        }

        return collect(json_decode($response->body()));
    }

    /**
     * @param int $page
     * @return Collection
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function getTopMovies(int $page): Collection
    {
        return $this->getData($this->topMoviesPath(), ['page' => $page]);
    }

    /**
     * @return Collection
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function getGenres(): Collection
    {
        return $this->getData($this->genresPath());
    }

    /**
     * @param int $id
     * @return Collection
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function getPerson(int $id): Collection
    {
        return $this->getData($this->personPath($id));
    }

    /**
     * @param int $id
     * @param array $appendToResponse
     * @return Collection
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function getDetails(int $id, array $appendToResponse)
    {
        $appendToResponse = [
            'append_to_response' => implode(',', $appendToResponse)
        ];

        return $this->getData($this->detailsPath($id), $appendToResponse);

    }
}
