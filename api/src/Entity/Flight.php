<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\JoinTable;

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
     * @ORM\ManyToMany(targetEntity="App\Entity\Crew", inversedBy="flights_arrival")
     * @ORM\JoinTable(name="flight_crew")
     */
    public $crewMembers;


    /**
     * @var Airport arrival of the flight
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Airport", inversedBy="flights_arrival")
     * @ORM\JoinColumn(name="flights_arrival", referencedColumnName="id")
     */
    public $airportArrival;

    /**
     * @ManyToOne(targetEntity="Company", inversedBy="flights")
     * @JoinColumn(name="company_id", referencedColumnName="id")
     */
    private $company;

    /**
     * @OneToMany(targetEntity="Reservation", mappedBy="flight")
     */
    private $reservations;

    /**
     * @ManyToOne(targetEntity="Plane", inversedBy="flights")
     * @JoinColumn(name="plane_id", referencedColumnName="id")
     */
    private $plane;

    /**
     * @ManyToOne(targetEntity="Gate", inversedBy="flights")
     * @JoinColumn(name="gate_id", referencedColumnName="id")
     */
    private $gate;

    public function __construct()
    {
        $this->crewMembers = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

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

    /**
     * @return Collection|Crew[]
     */
    public function getCrewMembers(): Collection
    {
        return $this->crewMembers;
    }

    public function addCrewMember(Crew $crewMember): self
    {
        if (!$this->crewMembers->contains($crewMember)) {
            $this->crewMembers[] = $crewMember;
        }

        return $this;
    }

    public function removeCrewMember(Crew $crewMember): self
    {
        if ($this->crewMembers->contains($crewMember)) {
            $this->crewMembers->removeElement($crewMember);
        }

        return $this;
    }

    public function getAirportArrival(): ?Airport
    {
        return $this->airportArrival;
    }

    public function setAirportArrival(?Airport $airportArrival): self
    {
        $this->airportArrival = $airportArrival;

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setFlight($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->contains($reservation)) {
            $this->reservations->removeElement($reservation);
            // set the owning side to null (unless already changed)
            if ($reservation->getFlight() === $this) {
                $reservation->setFlight(null);
            }
        }

        return $this;
    }
}
