<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\TerminalRepository")
 */
class Terminal
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var Airport arrival of terminal
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Airport", inversedBy="terminals")
     * @ORM\JoinColumn(name="terminals", referencedColumnName="id")
     */
    public $airport;

    /**
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Gate", mappedBy="terminal")
     */
    public $gates;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
