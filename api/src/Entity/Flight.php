<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\OneToMany;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\Airport", inversedBy="flights")
     * @ORM\JoinColumn(name="flights", referencedColumnName="id")
     */
    public $airportArrival;

    /**
     * @ManyToOne(targetEntity="Company", inversedBy="flights")
     * @JoinColumn(name="company_id", referencedColumnName="id")
     */
    private $company;

    /**
     * @OneToOne(targetEntity="Reservation", inversedBy="flight")
     */
    private $reservation;

    /**
     * @ManyToOne(targetEntity="Plane", inversedBy="flights")
     * @JoinColumn(name="plane_id", referencedColumnName="id")
     */
    private $plane;

    /**
     * @ManyToOne(targetEntity="Gate", inversedBy="flights")
     * @JoinColumn(name="flights", referencedColumnName="id")
     */
    private $gate;

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

    public function setDuration(?string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): self
    {
        $this->reservation = $reservation;

        return $this;
    }

    public function getPlane(): ?Plane
    {
        return $this->plane;
    }

    public function setPlane(?Plane $plane): self
    {
        $this->plane = $plane;

        return $this;
    }

    public function getGate(): ?Gate
    {
        return $this->gate;
    }

    public function setGate(?Gate $gate): self
    {
        $this->gate = $gate;

        return $this;
    }
}
