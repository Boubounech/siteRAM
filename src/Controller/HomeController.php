<?php


namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Game;
use App\Form\CommentType;
use App\Form\ResearchType;
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
            "games" => $games
        ]);
    }

    /**
     * @Route("/game-{id}", name="OneGame")
     * @return Response
     */
    public function select(Game $game, Request $request): Response
    {
        $comment = new Comment();
        $comment->setGame($game->getId());
        $form = $this->createForm(CommentType::class, $comment)->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->getDoctrine()->getManager()->persist($comment);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute("OneGame", ["id" => $game->getId()]);
        }
        $comments = $this->getDoctrine()->getRepository(Comment::class)->findBy(array("game"=>$game->getId()));
        return $this->render("game.html.twig", [
            "game" => $game,
            "comments" => $comments,
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/page", name="AllGames")
     * @return Response
     */
    public function allGamesPaginated(): Response
    {
        $games = $this->getDoctrine()->getRepository(Game::class)->findAll();
        return $this->render("allGames.html.twig", [
            "games" => $games
        ]);
    }

    /**
     * @Route("/search-{nam}-{cate}-{gen}", name="SearchGames")
     * @return Response
     */
    public function researchGames(Request $request, string $nam, string $cate, string $gen) : Response
    {
        $form = $this->createForm(CommentType::class)->handleRequest($request);
        $games = $this->getDoctrine()->getRepository(Game::class)->findByNameAndCategoryAndGenre('Jeu', 'oui', 'non');
        return $this->render("search.html.twig", [
            "games" => $games,
            "form" => $form->createView()
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