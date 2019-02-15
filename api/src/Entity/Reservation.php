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
 *     normalizationContext={"groups"={"read_reservation"}},
 *     denormalizationContext={"groups"={"write_reservation"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRepository")
 */
class Reservation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read_reservation", "write_reservation"})
     */
    private $price;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"read_reservation", "write_reservation", "read_user", "read_bagage"})
     */
    private $reservation_date;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="reservations")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * One reservation has One flight.
     *
     * @ManyToOne(targetEntity="Flight", inversedBy="reservation")
     * @JoinColumn(name="flight_id", referencedColumnName="id")
     * @Groups({"read_reservation", "write_reservation"})
     */
    private $flight;

    /**
     * @OneToMany(targetEntity="Bagage", mappedBy="reservation")
     * @Groups({"read_reservation"})
     */
    private $bagages;

    public function __construct()
    {
        $this->bagages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getReservationDate(): ?\DateTimeInterface
    {
        return $this->reservation_date;
    }

    public function setReservationDate(\DateTimeInterface $reservation_date): self
    {
        $this->reservation_date = $reservation_date;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getFlight(): ?Flight
    {
        return $this->flight;
    }

    public function setFlight(?Flight $flight): self
    {
        $this->flight = $flight;

        return $this;
    }

    /**
     * @return Collection|Bagage[]
     */
    public function getBagages(): Collection
    {
        return $this->bagages;
    }

    public function addBagage(Bagage $bagage): self
    {
        if (!$this->bagages->contains($bagage)) {
            $this->bagages[] = $bagage;
            $bagage->setReservation($this);
        }

        return $this;
    }

    public function removeBagage(Bagage $bagage): self
    {
        if ($this->bagages->contains($bagage)) {
            $this->bagages->removeElement($bagage);
            // set the owning side to null (unless already changed)
            if ($bagage->getReservation() === $this) {
                $bagage->setReservation(null);
            }
        }

        return $this;
    }
}
