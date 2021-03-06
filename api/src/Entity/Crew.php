<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="App\Repository\CrewRepository")
 */
class Crew
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
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="boolean")
     */
    private $gender;

    /**
     * @ORM\Column(type="datetime")
     */
    private $birthday;

    /**
     * @var \Doctrine\Common\Collections\Collection|Flight[]
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Flight", mappedBy="crewMembers")
     */
    public $flights;

    public function __construct()
    {
        $this->flights_arrival = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getGender(): ?bool
    {
        return $this->gender;
    }

    public function setGender(bool $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * @return Collection|Flight[]
     */
    public function getFlightsArrival(): Collection
    {
        return $this->flights_arrival;
    }

    public function addFlightsArrival(Flight $flightsArrival): self
    {
        if (!$this->flights_arrival->contains($flightsArrival)) {
            $this->flights_arrival[] = $flightsArrival;
            $flightsArrival->addCrewMember($this);
        }

        return $this;
    }

    public function removeFlightsArrival(Flight $flightsArrival): self
    {
        if ($this->flights_arrival->contains($flightsArrival)) {
            $this->flights_arrival->removeElement($flightsArrival);
            $flightsArrival->removeCrewMember($this);
        }

        return $this;
    }
}
