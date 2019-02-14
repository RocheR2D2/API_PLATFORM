<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\FlightRepository")
 */
class Flight
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
    private $registrationNumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $duration;

    /**
     * @var crew members of the flight
     * @ORM\ManyToMany(targetEntity="App\Entity\Crew", inversedBy="flights")
     * @ORM\JoinColumn(name="flights", referencedColumnName="id")
     */
    public $crewMembers;

    /**
     * @var Airport arrival of the flight
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Airport", inversedBy="flights_arrival")
     * @ORM\JoinColumn(name="flights_arrival", referencedColumnName="id")
     */
    public $airportArrival;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegistrationNumber(): ?string
    {
        return $this->registrationNumber;
    }

    public function setRegistrationNumber(string $registrationNumber): self
    {
        $this->registrationNumber = $registrationNumber;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(?string $dduration): self
    {
        $this->duration = $dduration;

        return $this;
    }
}
