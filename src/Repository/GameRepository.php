<?php

namespace App\Repository;

use App\Entity\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Game|null find($id, $lockMode = null, $lockVersion = null)
 * @method Game|null findOneBy(array $criteria, array $orderBy = null)
 * @method Game[]    findAll()
 * @method Game[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @ORM\Entity
 * @ORM\Table(name="game_repository")
 */
class GameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }

    //public function createGame(Game $game)
    //{
    //    return $this->getEntityManager()->createQuery(
    //        'INSERT INTO App\Entity\Game ("name", "creator", "link", "category", "genre", "dlNumber")
    //        VALUES (:name, :creator, :link, :category, :genre, 0)'
    //    )->setParameters(array('name' => $game->getName(), 'creator' => $game->getCreator(), 'link' => $game->getLink(), 'category' => $game->getCategory(), 'genre' => $game->getGenre()))
    //        ->getResult();
    //}
}
