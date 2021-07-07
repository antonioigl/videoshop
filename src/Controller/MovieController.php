<?php


namespace App\Controller;


use App\Entity\Movie;
use App\Form\MovieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use videoShop\Movie\Application\Find\FindMovieQuery;
use videoShop\Movie\Application\Find\FindMovieHandler;
use videoShop\Movie\Application\Store\StoreMovieCommand;
use videoShop\Movie\Application\Store\StoreMovieHandler;
use videoShop\Movie\Application\Update\UpdateMovieCommand;
use videoShop\Movie\Application\Update\UpdateMovieHandler;
use videoShop\Movie\Domain\MovieNotFound;

class MovieController extends AbstractController
{

    /**
     * @Route("/movies/create", name="movies.create", methods={"GET"})
     */
    public function create(): Response
    {
        $movie = new Movie();
        $form = $this->createForm(MovieType::class, $movie, [
            'action' => $this->generateUrl('movies.store'),
            'method' => 'POST',
        ]);

        return $this->render(
            'movies/create.html.twig',
            ['form' => $form->createView()]
        );
    }


    /**
     * @Route("/movies", name="movies.store", methods={"POST"})
     */
    public function store(Request $request, StoreMovieHandler $storeMovieHandler): Response
    {
        $movie = new Movie();
        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $command = new StoreMovieCommand($movie->getTitle(), $movie->getDescription());
            $response = $storeMovieHandler($command);
            $response->isStatus() ? $this->addFlash('message', 'Movie saved correctly') : $this->addFlash('message', 'Error saving movie');
            return $this->redirectToRoute('movies.create');
        }

        return $this->render(
            'movies/create.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * @Route("/movies/{id}/edit", name="movies.edit", methods={"GET"})
     */
    public function edit(int $id, FindMovieHandler $findMovieHandler): Response
    {
        try {
            $command = new FindMovieQuery($id);
            $response = $findMovieHandler($command);
            $movie = new Movie();
            $movie->setTitle($response->getMovie()->getTitle());
            $movie->setDescription($response->getMovie()->getDescription());

            $form = $this->createForm(MovieType::class, $movie, [
                'action' => $this->generateUrl('movies.update', ['id' => $id]),
                'method' => 'POST',
            ]);

            return $this->render(
                'movies/edit.html.twig',
                [
                    'form' => $form->createView(),
                ]
            );

        } catch (MovieNotFound $e) {
            throw $this->createNotFoundException($e->getMessage());
        }

    }

    /**
     * @Route("/movies/{id}", name="movies.update", methods={"POST"})
     * @param int $id
     * @param Request $request
     * @param UpdateMovieHandler $updateMovieHandler
     * @return Response
     */
    public function update(int $id, Request $request, UpdateMovieHandler $updateMovieHandler): Response
    {
        $movie = new Movie();
        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $command = new UpdateMovieCommand($id, $movie->getTitle(), $movie->getDescription());
            $response = $updateMovieHandler($command);
            $response->isStatus() ? $this->addFlash('message', 'Movie updated correctly') : $this->addFlash('message', 'Error updating movie');
            return $this->redirectToRoute('movies.edit', ['id' => $id]);
        }

        return $this->render(
            'movies/edit.html.twig',
            ['form' => $form->createView()]
        );
    }
}