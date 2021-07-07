<?php


namespace videoShop\Movie\Application\Find;

use videoShop\Movie\Domain\MovieNotFound;
use videoShop\Movie\Domain\MovieRepository;

class FindMovieHandler
{
    private MovieRepository $movieRepository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    /**
     * @param FindMovieQuery $findMovieCommand
     * @return FindMovieResponse
     * @throws MovieNotFound
     */
    public function __invoke(FindMovieQuery $findMovieCommand): FindMovieResponse
    {
        $response = $this->movieRepository->findMovie($findMovieCommand->getId());

        return new FindMovieResponse($response);
    }
}