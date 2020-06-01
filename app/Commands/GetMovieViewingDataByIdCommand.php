<?php

namespace App\Commands;

use App\Services\TraktClient;
use LaravelZero\Framework\Commands\Command;

class GetMovieViewingDataByIdCommand extends Command
{
    protected $signature = 'get-viewing-data-by-id {id}';

    protected $description = 'Get a movie viewing data using his TMDB id';

    public function handle()
    {
        $client = new TraktClient;
        
        $movieData = $client->getTraktIdBytmdbId($this->argument('id'));

        if (empty($movieData))
        {
            return $this->line('Could not find the movie');
        }

        $viewData = $client->getMovieViewingDataByTraktId($movieData[0]->movie->ids->trakt);

        $this->line("title: {$movieData[0]->movie->title}");
        $this->line("year: {$movieData[0]->movie->year}");
        $this->line("slug: {$movieData[0]->movie->ids->slug}");
        $this->line("watchers: $viewData->watchers");
        $this->line("plays: $viewData->plays");
        $this->line("collectors: $viewData->collectors");
        $this->line("comments: $viewData->comments");
        $this->line("lists: $viewData->lists");
        $this->line("votes: $viewData->votes");
    }
}
