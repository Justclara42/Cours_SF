<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

//use App\Entity\User;

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
//        $form = $this->createFormBuilder()
//            ->add('username', TextType::class)
//            ->add('password', TextType::class)
//            ->getForm();

        return $this->render('user/login.html.twig', [
            //'form' => $form->createView(),
        ]);
    }
}
