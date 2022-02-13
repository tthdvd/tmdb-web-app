<?php

namespace Tests\Unit;

use App\Services\DirectorService;
use Tests\TestCase;

class DirectorServiceTest extends TestCase
{
    /**
     * A basic unit test for director sync.
     *
     * @return void
     */
    public function test_director_sync()
    {
        $directorService = new DirectorService();
        $this->assertTrue($directorService->syncDirectors());
    }
}
