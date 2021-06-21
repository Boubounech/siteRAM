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

    public function findByNameAndCategoryAndGenre(string $name, string $cate, string $genre): array
    {
        return $this->getEntityManager()->createQuery(
            'SELECT g
            FROM App\Entity\Game AS g
            WHERE g.name LIKE :name'
        )->setParameter('name', '%'.$name.'%')
            ->getResult();

    }
}
