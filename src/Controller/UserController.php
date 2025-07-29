<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\User;

class UserController extends AbstractController
{
    #[Route('/user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig');
    }
    #[Route('/user/register')]
    public function register(): Response
    {
        return $this->render('user/register.html.twig');
    }
    #[Route('/user/login')]
    public function login(): Response
    {
        return $this->render('user/login.html.twig');
    }
}
