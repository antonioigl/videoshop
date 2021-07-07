<?php


namespace videoShop\User\Application\Register;


use videoShop\User\Domain\UserBuilder;
use videoShop\User\Domain\UserRepository;

class RegisterHandler
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * RegisterHandler constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(RegisterCommand $command): RegisterResponse
    {
        $user = UserBuilder::create(
            $command->getUsername(),
            $command->getEmail(),
            $command->getPassword(),
            $command->getRoles()
        )->build();
        $response = $this->userRepository->register($user);
        return new RegisterResponse($response);
    }
}