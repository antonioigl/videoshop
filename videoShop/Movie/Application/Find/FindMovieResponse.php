<?php


namespace videoShop\Movie\Application\Find;


use videoShop\Movie\Domain\Movie;

class FindMovieResponse
{

    private Movie $movie;

    public function __construct(Movie $movie)
    {

        $this->movie = $movie;
    }

    /**
     * @return Movie
     */
    public function getMovie(): Movie
    {
        return $this->movie;
    }
}