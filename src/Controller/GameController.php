<?php


namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Game;
use App\Entity\User;
use App\Form\CommentType;
use App\Form\GameType;
use App\Form\ResearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

/**
 * Class GameController
 * @package App\Controller
 */
class GameController extends AbstractController
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

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
        if ($this->security->isGranted("IS_AUTHENTICATED_FULLY")) {
            $comment->setCreator($this->getUser()->getPseudo());
        }
        $comment->setGame($game->getId());
        $form = $this->createForm(CommentType::class, $comment)->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->getDoctrine()->getManager()->persist($comment);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute("OneGame", ["id" => $game->getId()]);
        }
        $user = $this->getDoctrine()->getRepository(User::class)->find($game->getCreator());
        $comments = $this->getDoctrine()->getRepository(Comment::class)->findBy(array("game"=>$game->getId()));
        return $this->render("game.html.twig", [
            "game" => $game,
            "comments" => $comments,
            "form" => $form->createView(),
            "user" => $user
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
        return $this->render("search.html.twig", [
            "games" => $games,
            "name" => $nam,
            "category" => $cate,
            "genre" => $gen
        ]);
    }

    /**
     * @Route("/createGame", name="CreateGame")
     * @param Request $request
     * @return Response
     */
    public function createGame(Request $request) : Response
    {
        $em = $this->getDoctrine()->getManager();

        $game = new Game();

        $game->setCreator($this->getUser()->getId());
        $game->setDlnumber(0);

        $form = $this->createForm(GameType::class, $game)->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($game);
            $em->flush();
            return $this->redirectToRoute("OneGame", ["id" => $game->getId()]);
        }

        return $this->render("createGame.html.twig", [
            "form" => $form->createView()
        ]);
    }
}