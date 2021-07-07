<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use videoShop\User\Application\Register\RegisterCommand;
use videoShop\User\Application\Register\RegisterHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AuthController extends AbstractController
{

    /**
     * @Route("/register", name="register")
     * @param Request $request
     * @param RegisterHandler $registerHandler
     * @return Response
     */
    public function register(Request $request, RegisterHandler $registerHandler): Response
    {
        if ($this->getUser()) return $this->redirectToRoute('dashboard');

        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $command = new RegisterCommand($user->getEmail(), $user->getUsername(), $user->getPlainPassword(), $user->getRoles());
            $response = $registerHandler($command);
            if ($response->isStatus()) return $this->redirectToRoute('login');
        }

        return $this->render(
            'auth/register.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/login", name="login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        if ($this->getUser()) return $this->redirectToRoute('dashboard');

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('auth/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
