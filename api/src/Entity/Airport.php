<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={
 *         "get",
 *         "post"={"validation_groups"={"Default", "postValidation"}}
 *     },
 *     itemOperations={
 *         "delete",
 *         "get",
 *         "put"={"validation_groups"={"Default", "putValidation"}}
 *     },
 *     normalizationContext={"groups"={"read_airport"}},
 *     denormalizationContext={"groups"={"write_airport"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\AirportRepository")
 */
class Airport
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read_airport", "write_airport"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read_airport", "write_airport"})
     */
    private $country;

    /**
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Flight", mappedBy="airportArrival")
     * @Groups({"read_airport"})
     */
    public $flights;

    /**
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Terminal", mappedBy="airport")
     * @Groups({"read_airport"})
     */
    public $terminals;

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

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }
}
