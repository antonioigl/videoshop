<?php


namespace videoShop\Movie\Application\Update;


use videoShop\Movie\Domain\MovieBuilder;
use videoShop\Movie\Domain\MovieRepository;

class UpdateMovieHandler
{
    private MovieRepository $movieRepository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function __invoke(UpdateMovieCommand $updateMovieCommand): UpdateMovieResponse
    {
        $movie = MovieBuilder::create(
            $updateMovieCommand->getTitle(),
            $updateMovieCommand->getDescription(),
        )->withId($updateMovieCommand->getId())->build();

        $response = $this->movieRepository->update($movie);

        return new UpdateMovieResponse($response);
    }
}