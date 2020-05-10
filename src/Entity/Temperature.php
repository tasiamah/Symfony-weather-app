<?php

namespace App\Entity;

use App\Repository\TemperatureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TemperatureRepository::class)
 */
class Temperature
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $stationId;

    /**
     * @ORM\ManyToOne(targetEntity=Stations::class, inversedBy="temperatures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $station;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $value;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getStationId(): ?int
    {
        return $this->stationId;
    }

    public function setStationId(int $stationId): self
    {
        $this->stationId = $stationId;

        return $this;
    }

    public function getStation(): ?Stations
    {
        return $this->station;
    }

    public function setStation(?Stations $station): self
    {
        $this->station = $station;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }
}
