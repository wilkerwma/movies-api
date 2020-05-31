<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Illuminate\Support\Facades\Http;

class GetMovieViewingDataCommand extends Command
{
    const BASE_URL = 'http://www.omdbapi.com/?';
    const API_KEY  = '910bbdb3';
    
    protected $signature = 'get-viewing-data {title} {year}';

    protected $description = 'Get a movie viewing data using his title and year';

    public function handle()
    {
        $data = [
            't'      => $this->argument('title'),
            'y'      => $this->argument('year'),
            'apikey' => $this::API_KEY,
        ];

        $query    = http_build_query($data);
        $response = Http::get($this::BASE_URL.$query);

        $movie = json_decode($response->getBody()->getContents());

        $this->line("Title: $movie->Title");
        $this->line("Year: $movie->Year");
        $this->line("Rated: $movie->Rated");
        $this->line("Released: $movie->Released");
        $this->line("RunTime: $movie->Runtime");
        $this->line("Awards: $movie->Awards");
        $this->line("Metascore: $movie->Metascore");
        $this->line("imdbRating: $movie->imdbRating");
        $this->line("imdbVotes: $movie->imdbVotes");
    }
}
