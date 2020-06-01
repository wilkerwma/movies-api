<?php

namespace App\Commands;

use App\Services\TraktClient;
use LaravelZero\Framework\Commands\Command;

class GetMovieViewingDataByQueryCommand extends Command
{
    protected $signature = 'get-viewing-data-by-query {name} {year}';

    protected $description = 'Get a movie viewing data using a query';

    public function handle()
    {
        $client = new TraktClient;
        
        $movieData = $client->getTraktIdByNameAndYear($this->argument('name'), $this->argument('year'));
        
        if (empty($movieData))
        {
            return $this->line('Could not find the movie');
        }

        $viewData = $client->getMovieViewingDataByTraktId($movieData->ids->trakt);
        
        $this->line("title: {$movieData->title}");
        $this->line("year: {$movieData->year}");
        $this->line("slug: {$movieData->ids->slug}");
        $this->line("watchers: $viewData->watchers");
        $this->line("plays: $viewData->plays");
        $this->line("collectors: $viewData->collectors");
        $this->line("comments: $viewData->comments");
        $this->line("lists: $viewData->lists");
        $this->line("votes: $viewData->votes");
    }
}
