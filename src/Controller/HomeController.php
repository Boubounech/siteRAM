<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="HomeRAM")
     * @return Response
     */
    public function index(Request $request): Response
    {
        return $this->render("index.html.twig", [
            "FirstName" => "Boun"
        ]);
    }
}