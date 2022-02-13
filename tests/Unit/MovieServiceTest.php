<?php

namespace Tests\Unit;

use App\Services\MovieService;
use Tests\TestCase;

class MovieServiceTest extends TestCase
{
    /**
     * Test the movie sync.
     *
     * @return void
     */
    public function test_sync_movies()
    {
        $amount = 210;
        $movieServices = new MovieService();
        $syncedMovies = $movieServices->syncMovies($amount);

        // We not just test, if the amount is same,
        // but if the return value is not instance of Collection it will be failed
        $this->assertTrue($syncedMovies->count() === $amount);
    }

    /**
     * Test movie details sync
     *
     * @return void
     */
    public function test_sync_details()
    {
        $movieServices = new MovieService();
        $syncedDetails = $movieServices->syncMovieDetails();

        $this->assertTrue($syncedDetails);
    }

}
