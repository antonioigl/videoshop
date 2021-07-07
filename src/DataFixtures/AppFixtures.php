<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private UserPasswordEncoderInterface $passwordEncoder;


    /**
     * AppFixtures constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $userEntityAdmin = new User();
        $userEntityAdmin->setEmail("admin@admin.com");
        $userEntityAdmin->setUsername("Admin");
        $userEntityAdmin->setPlainPassword('123456');
        $password = $this->passwordEncoder->encodePassword($userEntityAdmin, $userEntityAdmin->getPlainPassword());
        $userEntityAdmin->setPassword($password);
        $userEntityAdmin->setRoles(['ROLE_ADMIN']);
        $manager->persist($userEntityAdmin);

        $userEntityUser = new User();
        $userEntityUser->setEmail("user@user.com");
        $userEntityUser->setUsername("User");
        $userEntityUser->setPlainPassword('123456');
        $password = $this->passwordEncoder->encodePassword($userEntityUser, $userEntityUser->getPlainPassword());
        $userEntityUser->setPassword($password);
        $userEntityUser->setRoles(['ROLE_USER']);
        $manager->persist($userEntityUser);

        $manager->flush();
    }
}
