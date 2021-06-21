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
     * @Route("/search", name="SearchGames", methods="GET")
     * @return Response
     */
    public function researchGames(Request $request) : Response
    {
        $nam = $request->query->get('nam');
        $cate = $request->query->get('cate');
        $gen = $request->query->get('gen');
        $games = $this->getDoctrine()->getRepository(Game::class)->findByNameAndCategoryAndGenre($nam, $cate, $gen);
        //$games = $this->getDoctrine()->getRepository(Game::class)->findAll();
        return $this->render("search.html.twig", [
            "games" => $games,
            "name" => $nam,
            "category" => $cate,
            "genre" => $gen
        ]);
    }
}