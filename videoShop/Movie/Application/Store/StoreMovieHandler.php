<?php


namespace videoShop\Movie\Application\Store;


use videoShop\Movie\Domain\MovieBuilder;
use videoShop\Movie\Domain\MovieRepository;

class StoreMovieHandler
{
    private MovieRepository $movieRepository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function __invoke(StoreMovieCommand $storeMovieCommand): StoreMovieResponse
    {
        $movie = MovieBuilder::create(
            $storeMovieCommand->getTitle(),
            $storeMovieCommand->getDescription(),
        )->build();

        $response = $this->movieRepository->store($movie);

        return new StoreMovieResponse($response);
    }
}