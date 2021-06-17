<?php


namespace App\DataFixtures;


use App\Entity\Game;
use Doctrine\Persistence\ObjectManager;

/**
 * Class GameFixtures
 * @package App\DataFixtures
 */
class GameFixtures extends \Doctrine\Bundle\FixturesBundle\Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++)
        {
            $game = new Game();
            $game->setName("Jeu n°" . $i);
            $game->setGenre("genre n°" . $i);
            $game->setCategory("category n°" . $i);
            $manager->persist($game);
        }

        $manager->flush();
    }
}