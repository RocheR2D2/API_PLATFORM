<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\GateRepository")
 */
class Gate
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
     * @var Airport arrival of the flight
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Terminal", inversedBy="gates")
     * @ORM\JoinColumn(name="gates", referencedColumnName="id")
     */
    public $terminal;

    /**
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Flight", mappedBy="airportArrival")
     */
    public $flights;

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
