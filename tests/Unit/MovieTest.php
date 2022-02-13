<?php

namespace Tests\Unit;

use App\Models\Movie;
use Tests\TestCase;

class MovieTest extends TestCase
{
    /**
     * Test for generated poster url
     *
     * @return void
     */
    public function test_poster_url_generator()
    {
        $testPath = '/test.jpg';

        $generatedPosterUrl = Movie::generatePosterUrl($testPath);
        $controlUrl = config('movie.poster_url_base'). $testPath;

        $this->assertTrue($generatedPosterUrl === $controlUrl);
    }

    public function test_movie_url_generator()
    {
        $id = rand(1,100);
        $generatedUrl = Movie::generateUrl($id);
        $controlUrl = config('movie.movie_url_base') . $id;

        $this->assertTrue($generatedUrl === $controlUrl);
    }
}
