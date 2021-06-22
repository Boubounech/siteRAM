<?php


namespace App\Controller;



use App\Entity\Comment;
use App\Entity\Game;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/profile", name="Profil")
     */
    public function index(): Response
    {
        $games = $this->getDoctrine()->getManager()->getRepository(Game::class)
            ->findBy(array("creator" => $this->getUser()->getId()));
        $comments = $this->getDoctrine()->getManager()->getRepository(Comment::class)
            ->findBy(array("creator" => $this->getUser()->getPseudo()));
        return $this->render("profil.html.twig", [
            "games" => $games,
            "comments" => $comments
        ]);
    }

    /**
     * @Route("/changeInfos", name="ChangeInfos")
     * @param Request $request
     * @return Response
     */
    public function changeInfos(Request $request): Response
    {
        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find($this->getUser()->getId());

        $form = $this->createForm(UserType::class, $user)->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->getDoctrine()->getManager()->persist($user);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute("Profil");
        }
        return $this->render("changeInfos.html.twig", [
            "form" => $form->createView()
        ]);
    }
}