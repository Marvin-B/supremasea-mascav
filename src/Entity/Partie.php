<?php

namespace App\Entity;

use App\Repository\PartieRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PartieRepository::class)
 */
class Partie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $terrain_J1 = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $terrain_J2 = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $des = [];

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateFin = null;

    /**
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $gagnant = null;

    /**
     * @ORM\Column(type="integer")
     */
    private $quiLeTour = 1;

    public function __construct()
    {
        $this->dateDebut = new DateTime('now');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTerrainJ1(): ?array
    {
        return $this->terrain_J1;
    }

    public function setTerrainJ1(?array $terrain_J1): self
    {
        $this->terrain_J1 = $terrain_J1;

        return $this;
    }

    public function getTerrainJ2(): ?array
    {
        return $this->terrain_J2;
    }

    public function setTerrainJ2(?array $terrain_J2): self
    {
        $this->terrain_J2 = $terrain_J2;

        return $this;
    }

    public function getDes(): ?array
    {
        return $this->des;
    }

    public function setDes(?array $des): self
    {
        $this->des = $des;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getGagnant(): ?string
    {
        return $this->gagnant;
    }

    public function setGagnant(?string $gagnant): self
    {
        $this->gagnant = $gagnant;

        return $this;
    }

    public function getQuiLeTour(): ?int
    {
        return $this->quiLeTour;
    }

    public function setQuiLeTour(int $quiLeTour): self
    {
        $this->quiLeTour = $quiLeTour;

        return $this;
    }
}
