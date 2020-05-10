<?php

namespace App\Entity;

use App\Repository\StationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StationsRepository::class)
 */
class Stations
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $longitude;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $latitude;

    /**
     * @ORM\OneToMany(targetEntity=Precipitation::class, mappedBy="station")
     */
    private $precipitations;

    /**
     * @ORM\OneToMany(targetEntity=Temperature::class, mappedBy="station")
     */
    private $temperatures;
	
	/**
	 * @ORM\Column(type="string", length=50)
	 */
    private $code;
	
    public function __construct()
    {
        $this->precipitations = new ArrayCollection();
        $this->temperatures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * @return Collection|Precipitation[]
     */
    public function getPrecipitations(): Collection
    {
        return $this->precipitations;
    }

    public function addPrecipitation(Precipitation $precipitation): self
    {
        if (!$this->precipitations->contains($precipitation)) {
            $this->precipitations[] = $precipitation;
            $precipitation->setStation($this);
        }

        return $this;
    }

    public function removePrecipitation(Precipitation $precipitation): self
    {
        if ($this->precipitations->contains($precipitation)) {
            $this->precipitations->removeElement($precipitation);
            // set the owning side to null (unless already changed)
            if ($precipitation->getStation() === $this) {
                $precipitation->setStation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Temperature[]
     */
    public function getTemperatures(): Collection
    {
        return $this->temperatures;
    }

    public function addTemperature(Temperature $temperature): self
    {
        if (!$this->temperatures->contains($temperature)) {
            $this->temperatures[] = $temperature;
            $temperature->setStation($this);
        }

        return $this;
    }

    public function removeTemperature(Temperature $temperature): self
    {
        if ($this->temperatures->contains($temperature)) {
            $this->temperatures->removeElement($temperature);
            // set the owning side to null (unless already changed)
            if ($temperature->getStation() === $this) {
                $temperature->setStation(null);
            }
        }

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }
}
