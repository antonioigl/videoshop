<?php


namespace videoShop\User\Infrastructure;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use videoShop\Shared\Logger\LoggerManager;
use videoShop\User\Domain\User;
use videoShop\User\Domain\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class DoctrineRepository extends ServiceEntityRepository implements UserRepository
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private UserPasswordEncoderInterface $passwordEncoder;

    /**
     * DoctrineRepository constructor.
     * @param ManagerRegistry $registry
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(ManagerRegistry $registry, UserPasswordEncoderInterface $passwordEncoder)
    {
        parent::__construct($registry, \App\Entity\User::class);
        $this->passwordEncoder = $passwordEncoder;
    }

    public function register(User $user): bool
    {
        $userEntity = new \App\Entity\User();
        $userEntity->setEmail($user->getEmail());
        $userEntity->setUsername($user->getUsername());
        $userEntity->setPlainPassword($user->getPassword());
        $password = $this->passwordEncoder->encodePassword($userEntity, $userEntity->getPlainPassword());
        $userEntity->setPassword($password);
        try {
            $this->getEntityManager()->persist($userEntity);
            $this->getEntityManager()->flush();
            return true;
        } catch (ORMException $e) {
            LoggerManager::create()->logError($e->getMessage());
        }

    }
}