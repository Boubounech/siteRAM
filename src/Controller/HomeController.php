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
    public function index(): Response
    {
        $games = $this->getDoctrine()->getRepository(Game::class)->findAll();
        return $this->render("index.html.twig", [
            "games"=>$games
        ]);
    }

    # ça sert à rien en tant que tel, c'est juste pour ne pas le supprimer

    #public function index(Request $request): Response
    #{
    #    return $this->render("index.html.twig", [
    #        "FirstName" => "Boun"
    #    ]);
    #}
    #/**
    # * @Route("/hello/{FirstName}", name="hello", defaults={"FirstName":"You"})
    # * @return Response
    # */
    #public function hello($FirstName): Response
    #{
    #    return $this->render("index.html.twig", [
    #        "FirstName" => $FirstName
    #    ]);
    #}
}