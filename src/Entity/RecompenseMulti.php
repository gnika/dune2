<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RecompenseMulti
 *
 * @ORM\Table(name="recompense_multi")
 * @ORM\Entity
 */
class RecompenseMulti
{
    /**
     * @var int
     *
     * @ORM\Column(name="rem_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $remId;

    /**
     * @var int
     *
     * @ORM\Column(name="rem_id_lien", type="integer", nullable=false)
     */
    private $remIdLien;

    /**
     * @var int
     *
     * @ORM\Column(name="rem_renommee", type="integer", nullable=false)
     */
    private $remRenommee;

    /**
     * @var int
     *
     * @ORM\Column(name="rem_influence", type="integer", nullable=false)
     */
    private $remInfluence;

    /**
     * @var int
     *
     * @ORM\Column(name="rem_influence_faction", type="integer", nullable=false)
     */
    private $remInfluenceFaction;

    /**
     * @var int
     *
     * @ORM\Column(name="rem_gardien", type="integer", nullable=false)
     */
    private $remGardien;

    /**
     * @var int
     *
     * @ORM\Column(name="rem_gardien_faction", type="integer", nullable=false)
     */
    private $remGardienFaction;

    /**
     * @var int
     *
     * @ORM\Column(name="rem_serviteur", type="integer", nullable=false)
     */
    private $remServiteur;

    /**
     * @var int
     *
     * @ORM\Column(name="rem_serviteur_faction", type="integer", nullable=false)
     */
    private $remServiteurFaction;

    /**
     * @var int
     *
     * @ORM\Column(name="rem_epice", type="integer", nullable=false)
     */
    private $remEpice;

    /**
     * @var int
     *
     * @ORM\Column(name="rem_troupe", type="integer", nullable=false)
     */
    private $remTroupe;

    /**
     * @var int
     *
     * @ORM\Column(name="rem_vaisseau", type="integer", nullable=false)
     */
    private $remVaisseau;

    /**
     * @var int
     *
     * @ORM\Column(name="rem_corruption", type="integer", nullable=false)
     */
    private $remCorruption;

    /**
     * @var string
     *
     * @ORM\Column(name="rem_fnctn", type="text", length=65535, nullable=false)
     */
    private $remFnctn;

    /**
     * @var string
     *
     * @ORM\Column(name="rem_display", type="text", length=65535, nullable=false)
     */
    private $remDisplay;

    public function getRemId(): ?int
    {
        return $this->remId;
    }

    public function getRemIdLien(): ?int
    {
        return $this->remIdLien;
    }

    public function setRemIdLien(int $remIdLien): self
    {
        $this->remIdLien = $remIdLien;

        return $this;
    }

    public function getRemRenommee(): ?int
    {
        return $this->remRenommee;
    }

    public function setRemRenommee(int $remRenommee): self
    {
        $this->remRenommee = $remRenommee;

        return $this;
    }

    public function getRemInfluence(): ?int
    {
        return $this->remInfluence;
    }

    public function setRemInfluence(int $remInfluence): self
    {
        $this->remInfluence = $remInfluence;

        return $this;
    }

    public function getRemInfluenceFaction(): ?int
    {
        return $this->remInfluenceFaction;
    }

    public function setRemInfluenceFaction(int $remInfluenceFaction): self
    {
        $this->remInfluenceFaction = $remInfluenceFaction;

        return $this;
    }

    public function getRemGardien(): ?int
    {
        return $this->remGardien;
    }

    public function setRemGardien(int $remGardien): self
    {
        $this->remGardien = $remGardien;

        return $this;
    }

    public function getRemGardienFaction(): ?int
    {
        return $this->remGardienFaction;
    }

    public function setRemGardienFaction(int $remGardienFaction): self
    {
        $this->remGardienFaction = $remGardienFaction;

        return $this;
    }

    public function getRemServiteur(): ?int
    {
        return $this->remServiteur;
    }

    public function setRemServiteur(int $remServiteur): self
    {
        $this->remServiteur = $remServiteur;

        return $this;
    }

    public function getRemServiteurFaction(): ?int
    {
        return $this->remServiteurFaction;
    }

    public function setRemServiteurFaction(int $remServiteurFaction): self
    {
        $this->remServiteurFaction = $remServiteurFaction;

        return $this;
    }

    public function getRemEpice(): ?int
    {
        return $this->remEpice;
    }

    public function setRemEpice(int $remEpice): self
    {
        $this->remEpice = $remEpice;

        return $this;
    }

    public function getRemTroupe(): ?int
    {
        return $this->remTroupe;
    }

    public function setRemTroupe(int $remTroupe): self
    {
        $this->remTroupe = $remTroupe;

        return $this;
    }

    public function getRemVaisseau(): ?int
    {
        return $this->remVaisseau;
    }

    public function setRemVaisseau(int $remVaisseau): self
    {
        $this->remVaisseau = $remVaisseau;

        return $this;
    }

    public function getRemCorruption(): ?int
    {
        return $this->remCorruption;
    }

    public function setRemCorruption(int $remCorruption): self
    {
        $this->remCorruption = $remCorruption;

        return $this;
    }

    public function getRemFnctn(): ?string
    {
        return $this->remFnctn;
    }

    public function setRemFnctn(string $remFnctn): self
    {
        $this->remFnctn = $remFnctn;

        return $this;
    }

    public function getRemDisplay(): ?string
    {
        return $this->remDisplay;
    }

    public function setRemDisplay(string $remDisplay): self
    {
        $this->remDisplay = $remDisplay;

        return $this;
    }


}
