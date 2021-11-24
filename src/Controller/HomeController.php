<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use SYmfony\Component\HttpKernel\Exception\HttpException;
class HomeController extends AbstractController
{
    /**
     * @Route("/home/hello", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
	/**
     * @Route("/home/{nom?}/{age?}", name="home_route", requirements={"age"="\b[1-9][0-9]\b"})
     */
    public function index2(?string $nom, ?int $age): Response
    {
        if (!isset($nom) || !isset($age)) {
            throw new HttpException(404, 'On ne peut vous afficher la page de cette personne');
            }
        return $this->render('home/index.html.twig', [
            'nom' => $nom.'<br>',
            'age'=> $age
        ]);
    }
}
