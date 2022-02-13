<?php

namespace App\Console\Commands;

use App\Services\DirectorService;
use App\Services\MovieService;
use Illuminate\Console\Command;

class MovieDatabaseSyncAllData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movie-sync:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $movieService = new MovieService();

        $this->info('Movies sync has been started!');
        $syncMovies = $movieService->syncMovies();

        if($syncMovies) {
            $this->info('Movies sync ended successfully.');
        } else {
            $this->error('There was a problem during movie sync!');
        }

        $this->info("Details of the movies sync has been started!");
        $syncMovieDetails = $movieService->syncMovieDetails();

        if($syncMovieDetails) {
            $this->info('Details of the movies sync ended successfully.');
        } else {
            $this->error('There was a problem during details sync!');
        }

        $this->info("Directors sync has been started!");
        $directorService = new DirectorService();
        $syncDirectors = $directorService->syncDirectors();

        if($syncDirectors) {
            $this->info("Directors sync ended successfully.");
        } else {
            $this->error("There was a problem during directors sync!");
        }
    }
}
