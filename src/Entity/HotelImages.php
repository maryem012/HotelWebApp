<?php

namespace App\Entity;

use App\Repository\HotelImagesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: HotelImagesRepository::class)]
class HotelImages
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[Vich\UploadableField(mapping: 'hotel_image', fileNameProperty: 'hotelImagePath')]
    private ?File $hotelImageFile = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $hotelImagePath = null;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHotelImageFile(): ?File
    {
        return $this->hotelImageFile;
    }

    public function setHotelImageFile(?File $hotelImageFile = null): void
    {
        $this->hotelImageFile = $hotelImageFile;

        if (null !== $hotelImageFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getHotelImagePath(): ?string
    {
        return $this->hotelImagePath;
    }

    public function setHotelImagePath(?string $hotelImagePath): static
    {
        $this->hotelImagePath = $hotelImagePath;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function __toString(): string
    {
        return $this->hotelImagePath ?: 'New Image'; // Replace with a suitable default or property
    }
    #[ORM\ManyToOne(targetEntity: Hotel::class, inversedBy: 'Hotelimages')]
    #[ORM\JoinColumn(nullable: false)]
    private $hotel;

    public function getHotel(): ?Hotel
    {
        return $this->hotel;
    }

    public function setHotel(?Hotel $hotel): self
    {
        $this->hotel = $hotel;
        return $this;
    }
}
