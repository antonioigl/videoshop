<?php


namespace videoShop\Movie\Infrastructure;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use videoShop\Movie\Domain\Movie;
use videoShop\Movie\Domain\MovieBuilder;
use videoShop\Movie\Domain\MovieNotFound;
use videoShop\Movie\Domain\MovieRepository;
use function is_null;

class DoctrineMovieRepository extends ServiceEntityRepository implements MovieRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, \App\Entity\Movie::class);
    }

    public function store(Movie $movie): bool
    {
        $movieEntity = new \App\Entity\Movie();
        $movieEntity->setTitle($movie->getTitle());
        $movieEntity->setDescription($movie->getDescription());

        try {
            $this->getEntityManager()->persist($movieEntity);
            $this->getEntityManager()->flush();
            return true;
        } catch (ORMException $e) {
            LoggerManager::create()->logError($e->getMessage());
            return false;
        }
    }

    /**
     * @param int $id
     * @return Movie
     * @throws MovieNotFound
     */
    public function findMovie(int $id): Movie
    {
        try {
            $movie = $this->getEntityManager()->find('App:Movie', $id);
            if(is_null($movie)) throw new MovieNotFound();

            return MovieBuilder::create(
                $movie->getTitle(),
                $movie->getDescription(),
            )->withId($movie->getId())->build();

        } catch (ORMException $e) {
            LoggerManager::create()->logError($e->getMessage());
        }
    }

    /**
     * @param Movie $movie
     * @return bool
     */
    public function update(Movie $movie): bool
    {
        try {
            $movieEntity = $this->getEntityManager()->find('App:Movie', $movie->getId());

            $movieEntity->setTitle($movie->getTitle());
            $movieEntity->setDescription($movie->getDescription());
            $this->getEntityManager()->persist($movieEntity);
            $this->getEntityManager()->flush();
            return true;

        } catch (ORMException $e) {
            LoggerManager::create()->logError($e->getMessage());
            return false;
        }
    }
}