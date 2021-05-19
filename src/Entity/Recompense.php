<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recompense
 *
 * @ORM\Table(name="recompense")
 * @ORM\Entity
 */
class Recompense
{
    /**
     * @var int
     *
     * @ORM\Column(name="re_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $reId;

    /**
     * @var int
     *
     * @ORM\Column(name="re_id_ext", type="integer", nullable=false)
     */
    private $reIdExt;

    /**
     * @var int
     *
     * @ORM\Column(name="re_id_quete", type="integer", nullable=false)
     */
    private $reIdQuete;

    /**
     * @var int
     *
     * @ORM\Column(name="re_id_perso", type="integer", nullable=false)
     */
    private $reIdPerso;

    /**
     * @var int
     *
     * @ORM\Column(name="re_renommee", type="integer", nullable=false)
     */
    private $reRenommee;

    /**
     * @var int
     *
     * @ORM\Column(name="re_influence", type="integer", nullable=false)
     */
    private $reInfluence;

    /**
     * @var int
     *
     * @ORM\Column(name="re_influence_faction", type="integer", nullable=false)
     */
    private $reInfluenceFaction;

    /**
     * @var int
     *
     * @ORM\Column(name="re_gardien", type="integer", nullable=false)
     */
    private $reGardien;

    /**
     * @var int
     *
     * @ORM\Column(name="re_gardien_faction", type="integer", nullable=false)
     */
    private $reGardienFaction;

    /**
     * @var int
     *
     * @ORM\Column(name="re_serviteur", type="integer", nullable=false)
     */
    private $reServiteur;

    /**
     * @var int
     *
     * @ORM\Column(name="re_serviteur_faction", type="integer", nullable=false)
     */
    private $reServiteurFaction;

    /**
     * @var int
     *
     * @ORM\Column(name="re_epice", type="integer", nullable=false)
     */
    private $reEpice;

    /**
     * @var int
     *
     * @ORM\Column(name="re_eau", type="integer", nullable=false)
     */
    private $reEau;

    /**
     * @var int
     *
     * @ORM\Column(name="re_credit", type="integer", nullable=false)
     */
    private $reCredit;

    /**
     * @var int
     *
     * @ORM\Column(name="re_troupe", type="integer", nullable=false)
     */
    private $reTroupe;

    /**
     * @var int
     *
     * @ORM\Column(name="re_vaisseau", type="integer", nullable=false)
     */
    private $reVaisseau;

    /**
     * @var int
     *
     * @ORM\Column(name="re_corruption", type="integer", nullable=false)
     */
    private $reCorruption;

    /**
     * @var string
     *
     * @ORM\Column(name="re_fnctn", type="text", length=65535, nullable=false)
     */
    private $reFnctn;

    /**
     * @var string
     *
     * @ORM\Column(name="re_display", type="text", length=65535, nullable=false)
     */
    private $reDisplay;

    public function getReId(): ?int
    {
        return $this->reId;
    }

    public function getReIdExt(): ?int
    {
        return $this->reIdExt;
    }

    public function setReIdExt(int $reIdExt): self
    {
        $this->reIdExt = $reIdExt;

        return $this;
    }

    public function getReIdQuete(): ?int
    {
        return $this->reIdQuete;
    }

    public function setReIdQuete(int $reIdQuete): self
    {
        $this->reIdQuete = $reIdQuete;

        return $this;
    }

    public function getReIdPerso(): ?int
    {
        return $this->reIdPerso;
    }

    public function setReIdPerso(int $reIdPerso): self
    {
        $this->reIdPerso = $reIdPerso;

        return $this;
    }

    public function getReRenommee(): ?int
    {
        return $this->reRenommee;
    }

    public function setReRenommee(int $reRenommee): self
    {
        $this->reRenommee = $reRenommee;

        return $this;
    }

    public function getReInfluence(): ?int
    {
        return $this->reInfluence;
    }

    public function setReInfluence(int $reInfluence): self
    {
        $this->reInfluence = $reInfluence;

        return $this;
    }

    public function getReInfluenceFaction(): ?int
    {
        return $this->reInfluenceFaction;
    }

    public function setReInfluenceFaction(int $reInfluenceFaction): self
    {
        $this->reInfluenceFaction = $reInfluenceFaction;

        return $this;
    }

    public function getReGardien(): ?int
    {
        return $this->reGardien;
    }

    public function setReGardien(int $reGardien): self
    {
        $this->reGardien = $reGardien;

        return $this;
    }

    public function getReGardienFaction(): ?int
    {
        return $this->reGardienFaction;
    }

    public function setReGardienFaction(int $reGardienFaction): self
    {
        $this->reGardienFaction = $reGardienFaction;

        return $this;
    }

    public function getReServiteur(): ?int
    {
        return $this->reServiteur;
    }

    public function setReServiteur(int $reServiteur): self
    {
        $this->reServiteur = $reServiteur;

        return $this;
    }

    public function getReServiteurFaction(): ?int
    {
        return $this->reServiteurFaction;
    }

    public function setReServiteurFaction(int $reServiteurFaction): self
    {
        $this->reServiteurFaction = $reServiteurFaction;

        return $this;
    }

    public function getReEpice(): ?int
    {
        return $this->reEpice;
    }

    public function setReEpice(int $reEpice): self
    {
        $this->reEpice = $reEpice;

        return $this;
    }

    public function getReTroupe(): ?int
    {
        return $this->reTroupe;
    }

    public function setReTroupe(int $reTroupe): self
    {
        $this->reTroupe = $reTroupe;

        return $this;
    }

    public function getReVaisseau(): ?int
    {
        return $this->reVaisseau;
    }

    public function setReVaisseau(int $reVaisseau): self
    {
        $this->reVaisseau = $reVaisseau;

        return $this;
    }

    public function getReCorruption(): ?int
    {
        return $this->reCorruption;
    }

    public function setReCorruption(int $reCorruption): self
    {
        $this->reCorruption = $reCorruption;

        return $this;
    }

    public function getReFnctn(): ?string
    {
        return $this->reFnctn;
    }

    public function setReFnctn(string $reFnctn): self
    {
        $this->reFnctn = $reFnctn;

        return $this;
    }

    public function getReDisplay(): ?string
    {
        return $this->reDisplay;
    }

    public function setReDisplay(string $reDisplay): self
    {
        $this->reDisplay = $reDisplay;

        return $this;
    }

    /**
     * @return int
     */
    public function getReEau(): int
    {
        return $this->reEau;
    }

    /**
     * @param int $reEau
     */
    public function setReEau(int $reEau): void
    {
        $this->reEau = $reEau;
    }

    /**
     * @return int
     */
    public function getReCredit(): int
    {
        return $this->reCredit;
    }

    /**
     * @param int $reCredit
     */
    public function setReCredit(int $reCredit): void
    {
        $this->reCredit = $reCredit;
    }




}
