<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Game
 *
 * @ORM\Table(name="game")
 * @ORM\Entity
 */
class Game
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=25, nullable=false)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="creator", type="integer", nullable=false)
     */
    private $creator;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=false)
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=25, nullable=false)
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="genre", type="string", length=25, nullable=false)
     */
    private $genre;

    /**
     * @var int
     *
     * @ORM\Column(name="dlNumber", type="integer", nullable=false)
     */
    private $dlnumber;


}
