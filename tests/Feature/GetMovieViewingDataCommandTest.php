<?php

namespace Tests\Feature;

use Tests\TestCase;

class GetMobvieViewingDataCommandTest extends TestCase
{
    /**
     * A test for a list of movies.
     *
     * @return void
     */
    public function testGetMovieViewingDataCommand()
    {
        $movies = [
            ['title' => 'Fury', 'year' => '2014'],
            ['title' => 'Megamind', 'year' => '2010'],
            ['title' => 'Spy Game', 'year' => '2001'],
            ['title' => 'The Mexican', 'year' => '2001'],
            ['title' => 'Snatch', 'year' => '2000'],
            ['title' => 'Ocean\'s Eleven', 'year' => '2001'],
            ['title' => 'Ocean\'s Twelve', 'year' => '2004'],
            ['title' => 'Ocean\'s Thirteen', 'year' => '2007'],
            ['title' => 'Fight Club', 'year' => '1999'],
            ['title' => 'Troy', 'year' => '2004'],
            ['title' => 'Sleepers', 'year' => '1996'],
            ['title' => 'Seven Years in Tibet', 'year' => '1997'],
            ['title' => 'Babel', 'year' => '2006'],
            ['title' => 'The Devil\'s Own', 'year' => '1997'],
            ['title' => 'The Curious Case of Benjamin Button', 'year' => '2008'],
            ['title' => 'Burn After Reading', 'year' => '2008'],
            ['title' => 'Sinbad: Legend of the Seven Seas', 'year' => '2003'],
            ['title' => '12 Years a Slave', 'year' => '2013'],
            ['title' => 'Mr. & Mrs. Smith', 'year' => '2005'],
            ['title' => 'The Big Short', 'year' => '2015'],
            ['title' => 'Allied', 'year' => '2016'],
            ['title' => 'World War Z', 'year' => '2013'],
            ['title' => 'Being John Malkovich', 'year' => '1999'],
        ];

        foreach ($movies as $movie) {
            $commandTitle = '"' . $movie['title'] . '"';
            $rawTitle = $movie['title'];
            $year = $movie['year'];

            $this->artisan("get-viewing-data $commandTitle $year")
                ->expectsOutput("Title: $rawTitle")
                ->expectsOutput("Year: $year")
                ->assertExitCode(0);

            $this->assertCommandCalled("get-viewing-data $commandTitle $year");
        }
    }
}