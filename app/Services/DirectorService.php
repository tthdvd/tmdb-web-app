<?php

namespace App\Services;

use App\Repositories\DirectorSyncRepository;

class DirectorService
{
    private DirectorSyncRepository $directorSyncRepository;

    public function __construct()
    {
        $this->directorSyncRepository = new DirectorSyncRepository();
    }

    public function syncDirectors(): bool
    {
        return $this->directorSyncRepository->syncDirectors();
    }

}
