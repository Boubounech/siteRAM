<?php


namespace App\DataFixtures;


use App\Entity\Comment;
use App\Entity\Game;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Class GameFixtures
 * @package App\DataFixtures
 */
class GameFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++)
        {
            $game = new Game();
            $game->setId($i);
            $game->setName("Jeu n°" . $i);
            $game->setGenre("genre n°" . $i);
            $game->setCategory("category n°" . $i);
            $game->setCreator($i);
            $game->setDlnumber(0);
            $game->setLink("https://029gv.csb.app/");
            $manager->persist($game);

            for ($y = 1; $y <= 2; $y++)
            {
                $d = $i * 2 + $y;
                $comment = new Comment();
                $comment->setId($d);
                $comment->setCreator($i);
                $comment->setContent("Contenu n°".$y);
                $comment->setGame($i);
                $manager->persist($comment);
            }
        }

        $manager->flush();
    }
}