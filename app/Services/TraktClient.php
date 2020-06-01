<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TraktClient {


    public function getTraktIdBytmdbId(string $tmdbId)
    {

        $response = Http::withHeaders(                     
                [
                    'Content-type' => 'application/json',
                    'trakt-api-key' => config('services.trakt.client_id'),
                    'trakt-api-version' => 2
                ])
                ->get("https://api.trakt.tv/search/tmdb/$tmdbId?type=movie");

        return json_decode($response->getBody()->getContents());
    }

    public function getTraktIdByNameAndYear(string $name, string $year)
    {
        $slug = $name. " $year";

        $slug = str_replace([' ','\''], '-', $slug); 
		$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug); 
        $slug = strtolower($slug);
        $slug = str_replace(['--'], '-', $slug);

        $response = Http::withHeaders(                      [
                        'Content-type' => 'application/json',
                        'trakt-api-key' => config('services.trakt.client_id'),
                        'trakt-api-version' => 2
                    ]
                )
                ->get(config('services.trakt.url')."/movies/$slug");

        return json_decode($response->getBody()->getContents());
    }

    public function getMovieViewingDataByTraktId(string $traktId)
    {
        $response = Http::withHeaders(                     
            [
                    'Content-type' => 'application/json',
                    'trakt-api-key' => config('services.trakt.client_id'),
                    'trakt-api-version' => 2
                ]
            )
            ->get(config('services.trakt.url')."/movies/$traktId/stats");


        return json_decode($response->getBody()->getContents());
    }
}