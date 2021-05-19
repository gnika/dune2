<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\BatimentRepository;

/**
 * Batiment
 *
 * @ORM\Table(name="batiment")
 * @ORM\Entity(repositoryClass=BatimentRepository::class)
 */
class Batiment
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var epice
     *
     * @ORM\Column(name="epice", type="integer", nullable=false)
     */
    private $epice;

    /**
     * @var renommee
     *
     * @ORM\Column(name="renommee", type="integer", nullable=false)
     */
    private $renommee;

    /**
     * @var credit
     *
     * @ORM\Column(name="credit", type="integer", nullable=false)
     */
    private $credit;

    /**
     * @var troupe
     *
     * @ORM\Column(name="troupe", type="integer", nullable=false)
     */
    private $troupe;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $Nom;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->Nom;
    }

    /**
     * @param string $Nom
     */
    public function setNom(string $Nom): void
    {
        $this->Nom = $Nom;
    }

    /**
     * @return int
     */
    public function getEpice(): int
    {
        return $this->epice;
    }

    /**
     * @param int $epice
     */
    public function setEpice(int $epice): void
    {
        $this->epice = $epice;
    }

    /**
     * @return int
     */
    public function getRenommee(): int
    {
        return $this->renommee;
    }

    /**
     * @param int $renommee
     */
    public function setRenommee(int $renommee): void
    {
        $this->renommee = $renommee;
    }

    /**
     * @return int
     */
    public function getCredit(): int
    {
        return $this->credit;
    }

    /**
     * @param int $credit
     */
    public function setCredit(int $credit): void
    {
        $this->credit = $credit;
    }

    /**
     * @return int
     */
    public function getTroupe(): int
    {
        return $this->troupe;
    }

    /**
     * @param int $troupe
     */
    public function setTroupe(int $troupe): void
    {
        $this->troupe = $troupe;
    }





}
