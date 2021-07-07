<?php


namespace videoShop\Movie\Domain;


interface MovieRepository
{
//    public function index();

    /**
     * @param Movie $movie
     * @return bool
     */
    public function store(Movie $movie): bool;

    /**
     * @param int $id
     * @return Movie
     * @throws MovieNotFound
     */
    public function findMovie(int $id): Movie;


    public function update(Movie $movie);

    //    public function show($id);
//    public function destroy($id);
}