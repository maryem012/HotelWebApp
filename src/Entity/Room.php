<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\RoomTypes;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;



#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $room_type = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column]
    private ?bool $availability = null;

    #[ORM\Column(length: 255)]
    private ?string $amenities = null;

    #[ORM\ManyToOne(inversedBy: 'rooms')]
    private ?Hotel $hotel = null;

    #[ORM\OneToMany(mappedBy: 'room', targetEntity: RoomImages::class, cascade: ['persist', 'remove'])]
    private Collection $images;

    #[ORM\ManyToMany(targetEntity: Reservation::class, mappedBy: 'room_id')]
    private Collection $reservations;

    #[ORM\Column(length: 255)]
    private ?string $chamberNumber = null;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    #[Assert\Choice(choices: RoomTypes::class)]
    public function getRoomType(): ?string
    {
        return $this->room_type;
    }

    public function setRoomType(string $room_type): static
    {
        $this->room_type = $room_type;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function isAvailability(): ?bool
    {
        return $this->availability;
    }

    public function setAvailability(bool $availability): static
    {
        $this->availability = $availability;

        return $this;
    }

    public function getAmenities(): ?string
    {
        return $this->amenities;
    }

    public function setAmenities(string $amenities): static
    {
        $this->amenities = $amenities;

        return $this;
    }

    public function getHotel(): ?Hotel
    {
        return $this->hotel;
    }

    public function setHotel(?Hotel $hotel): static
    {
        $this->hotel = $hotel;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->addRoomId($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            $reservation->removeRoomId($this);
        }

        return $this;
    }



    public function getChamberNumber(): ?string
    {
        return $this->chamberNumber;
    }

    public function setChamberNumber(?string $chamberNumber): self
    {
        $this->chamberNumber = $chamberNumber;
        return $this;
    }

    public function __toString()
    {
        // This will be used to represent the Room object as a string in EasyAdmin
        return $this->getRoomInfo();
    }

    public function getRoomInfo(): string
    {
        return $this->getChamberNumber() . ' - ' . $this->getRoomType();
    }


    // Image related methods
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(RoomImages $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setRoom($this);
        }
        return $this;
    }

    public function removeImage(RoomImages $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            if ($image->getRoom() === $this) {
                $image->setRoom(null);
            }
        }
        return $this;
    }
}
