<?php

namespace App\Entity;

use App\Repository\HotelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HotelRepository::class)]
class Hotel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $contact_info = null;
    #[ORM\OneToMany(mappedBy: 'hotel', targetEntity: HotelImages::class, cascade: ['persist', 'remove'])]
    private Collection $HotelImages;
    #[ORM\OneToMany(mappedBy: 'hotel', targetEntity: Room::class)]
    private Collection $rooms;

    #[ORM\OneToMany(mappedBy: 'hotel', targetEntity: Staff::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Collection $staff;

    public function __construct()
    {
        $this->rooms = new ArrayCollection();
        $this->HotelImages = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getContactInfo(): ?string
    {
        return $this->contact_info;
    }

    public function setContactInfo(string $contact_info): static
    {
        $this->contact_info = $contact_info;

        return $this;
    }

    /**
     * @return Collection<int, Room>
     */
    public function getRooms(): Collection
    {
        return $this->rooms;
    }

    public function addRoom(Room $room): static
    {
        if (!$this->rooms->contains($room)) {
            $this->rooms->add($room);
            $room->setHotel($this);
        }

        return $this;
    }

    public function removeRoom(Room $room): static
    {
        if ($this->rooms->removeElement($room)) {
            // set the owning side to null (unless already changed)
            if ($room->getHotel() === $this) {
                $room->setHotel(null);
            }
        }

        return $this;
    }

    public function getStaff(): ?Staff
    {
        return $this->staff;
    }

    public function setStaff(?Staff $staff): static
    {
        $this->staff = $staff;

        return $this;
    }


    // Image related methods
    public function getHotelImages(): Collection
    {
        return $this->HotelImages;
    }

    public function addHotelImage(HotelImages $image): self
    {
        if (!$this->HotelImages->contains($image)) {
            $this->HotelImages[] = $image;
            $image->setHotel($this);
        }
        return $this;
    }

    public function removeImage(HotelImages $image): self
    {
        if ($this->HotelImages->contains($image)) {
            $this->HotelImages->removeElement($image);
            if ($image->getHotel() === $this) {
                $image->setHotel(null);
            }
        }
        return $this;
    }
}
