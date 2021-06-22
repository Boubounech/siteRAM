<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity
 */
class Comment
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="creator", type="string", nullable=true)
     * @Assert\NotBlank()
     */
    private ?string $creator;

    /**
     * @var string|null
     *
     * @ORM\Column(name="content", type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     */
    private ?string $content;

    /**
     * @var int
     *
     * @ORM\Column(name="game", type="integer", nullable=false)
     */
    private int $game;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getCreator(): ?string
    {
        return $this->creator;
    }

    /**
     * @param string $creator
     */
    public function setCreator(string $creator): void
    {
        $this->creator = $creator;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return int
     */
    public function getGame(): int
    {
        return $this->game;
    }

    /**
     * @param int $game
     */
    public function setGame(int $game): void
    {
        $this->game = $game;
    }


}
