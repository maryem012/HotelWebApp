<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Guest::class, inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Guest $guest = null;

    #[ORM\ManyToMany(targetEntity: Room::class, inversedBy: 'reservations')]
    private Collection $rooms;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $check_in_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $check_out_date = null;

    #[ORM\Column(nullable: true)]
    private ?float $total_price = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $status = null;

    #[ORM\OneToMany(mappedBy: 'reservation', targetEntity: Payment::class)]
    private Collection $payments;

    public function __construct()
    {
        $this->rooms = new ArrayCollection();
        $this->payments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGuest(): ?Guest
    {
        return $this->guest;
    }

    public function setGuest(?Guest $guest): self
    {
        $this->guest = $guest;
        return $this;
    }

    /**
     * @return Collection<int, Room>
     */
    public function getRooms(): Collection
    {
        return $this->rooms;
    }

    public function addRoom(Room $room): self
    {
        if (!$this->rooms->contains($room)) {
            $this->rooms[] = $room;
        }
        return $this;
    }

    public function removeRoom(Room $room): self
    {
        $this->rooms->removeElement($room);
        return $this;
    }

    public function getCheckInDate(): ?\DateTimeInterface
    {
        return $this->check_in_date;
    }

    public function setCheckInDate(\DateTimeInterface $check_in_date): self {
        $this->check_in_date = $check_in_date;
        $this->setTotalPrice($this->calculateTotalAmount());
        return $this;
    }

    public function getCheckOutDate(): ?\DateTimeInterface
    {
        return $this->check_out_date;
    }

    public function setCheckOutDate(\DateTimeInterface $check_out_date): self
    {
        $this->check_out_date = $check_out_date;
        $this->setTotalPrice($this->calculateTotalAmount());

        return $this;
    }

    public function getTotalPrice(): ?float
    {
        return $this->total_price;
    }

    public function setTotalPrice(?float $total_price): self
    {
        $this->total_price = $total_price;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return Collection<int, Payment>
     */
    public function getPayments(): Collection
    {
        return $this->payments;
    }

    public function addPayment(Payment $payment): self
    {
        if (!$this->payments->contains($payment)) {
            $this->payments[] = $payment;
            $payment->setReservation($this);
        }
        return $this;
    }

    public function removePayment(Payment $payment): self
    {
        if ($this->payments->removeElement($payment)) {
            // set the owning side to null (unless already changed)
            if ($payment->getReservation() === $this) {
                $payment->setReservation(null);
            }
        }
        return $this;
    }

    public function __toString() {
        // Return a string that represents this reservation, adjust according to your needs
        return "Reservation #" . $this->id . " for " . $this->guest;
        // This assumes you have a 'guest' property that can be converted to string.
        // Adjust accordingly if your setup is different.
    }
    public function getDurationOfStay(): ?int {
        if ($this->check_in_date && $this->check_out_date) {
            return $this->check_out_date->diff($this->check_in_date)->days;
        }
        return null;
    }
    public function calculateTotalAmount(): ?float {
        $totalAmount = 0;
        $duration = $this->getDurationOfStay();
        if ($duration) {
            foreach ($this->rooms as $room) {
                $totalAmount += ($room->getPrice() * $duration);
            }
        }
        return $totalAmount;
    }

}
