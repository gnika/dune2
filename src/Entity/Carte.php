<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CarteRepository;

/**
 * rte
 *
 * @ORM\Table(name="carte")
 * @ORM\Entity(repositoryClass=CarteRepository::class)
 */
class Carte
{
    /**
     * @var int
     *
     * @ORM\Column(name="ca_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $Id;

    /**
     * @var string
     *
     * @ORM\Column(name="ca_nom", type="string", length=255, nullable=false)
     */
    private $Nom;

    /**
     * @var string
     *
     * @ORM\Column(name="ca_description", type="text", length=65535, nullable=false)
     */
    private $Description;

    /**
     * @var string
     *
     * @ORM\Column(name="ca_coordonnees", type="string", length=255, nullable=false)
     */
    private $Coordonnees;

    /**
     * @var int
     *
     * @ORM\Column(name="ca_flotte", type="integer", nullable=false)
     */
    private $Flotte;

    /**
     * @var string
     *
     * @ORM\Column(name="ca_class", type="string", length=255, nullable=false)
     */
    private $caClass;

    /**
     * @var bool
     *
     * @ORM\Column(name="ca_zoom", type="boolean", nullable=false)
     */
    private $Zoom;

    /**
     * @var int
     *
     * @ORM\Column(name="ca_epice", type="integer", nullable=false)
     */
    private $Epice;

    /**
     * @var int
     *
     * @ORM\Column(name="ca_epice_jour", type="integer", nullable=false)
     */
    private $EpiceJour;

    /**
     * @var int
     *
     * @ORM\Column(name="ca_diplomate", type="integer", nullable=false)
     */
    private $Diplomate;

    /**
     * @var int
     *
     * @ORM\Column(name="ca_civ", type="integer", nullable=false)
     */
    private $Civ;

    /**
     * @var string
     *
     * @ORM\Column(name="ca_effet_diplo", type="text", length=65535, nullable=false)
     */
    private $EffetDiplo;

    public function getId(): ?int
    {
        return $this->Id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getCoordonnees(): ?string
    {
        return $this->Coordonnees;
    }

    public function setCoordonnees(string $Coordonnees): self
    {
        $this->Coordonnees = $Coordonnees;

        return $this;
    }

    public function getFlotte(): ?int
    {
        return $this->Flotte;
    }

    public function setFlotte(int $Flotte): self
    {
        $this->Flotte = $Flotte;

        return $this;
    }

    public function getClass(): ?string
    {
        return $this->caClass;
    }

    public function setClass(string $caClass): self
    {
        $this->caClass = $caClass;

        return $this;
    }

    public function getZoom(): ?bool
    {
        return $this->Zoom;
    }

    public function setZoom(bool $Zoom): self
    {
        $this->Zoom = $Zoom;

        return $this;
    }

    public function getEpice(): ?int
    {
        return $this->Epice;
    }

    public function setEpice(int $Epice): self
    {
        $this->Epice = $Epice;

        return $this;
    }

    public function getEpiceJour(): ?int
    {
        return $this->EpiceJour;
    }

    public function setEpiceJour(int $EpiceJour): self
    {
        $this->EpiceJour = $EpiceJour;

        return $this;
    }

    public function getDiplomate(): ?int
    {
        return $this->Diplomate;
    }

    public function setDiplomate(int $Diplomate): self
    {
        $this->Diplomate = $Diplomate;

        return $this;
    }

    public function getCiv(): ?int
    {
        return $this->Civ;
    }

    public function setCiv(int $Civ): self
    {
        $this->Civ = $Civ;

        return $this;
    }

    public function getEffetDiplo(): ?string
    {
        return $this->EffetDiplo;
    }

    public function setEffetDiplo(string $EffetDiplo): self
    {
        $this->EffetDiplo = $EffetDiplo;

        return $this;
    }


}
