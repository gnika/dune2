<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MultiMaj
 *
 * @ORM\Table(name="multi_maj")
 * @ORM\Entity
 */
class MultiMaj
{
    /**
     * @var int
     *
     * @ORM\Column(name="mum_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $mumId;

    /**
     * @var int
     *
     * @ORM\Column(name="mum_id_lien", type="integer", nullable=false)
     */
    private $mumIdLien;

    /**
     * @var int
     *
     * @ORM\Column(name="mum_id_quete", type="integer", nullable=false)
     */
    private $mumIdQuete;

    /**
     * @var int
     *
     * @ORM\Column(name="mum_id_perso", type="integer", nullable=false)
     */
    private $mumIdPerso;

    /**
     * @var int
     *
     * @ORM\Column(name="mum_id_ext", type="integer", nullable=false)
     */
    private $mumIdExt;

    public function getMumId(): ?int
    {
        return $this->mumId;
    }

    public function getMumIdLien(): ?int
    {
        return $this->mumIdLien;
    }

    public function setMumIdLien(int $mumIdLien): self
    {
        $this->mumIdLien = $mumIdLien;

        return $this;
    }

    public function getMumIdQuete(): ?int
    {
        return $this->mumIdQuete;
    }

    public function setMumIdQuete(int $mumIdQuete): self
    {
        $this->mumIdQuete = $mumIdQuete;

        return $this;
    }

    public function getMumIdPerso(): ?int
    {
        return $this->mumIdPerso;
    }

    public function setMumIdPerso(int $mumIdPerso): self
    {
        $this->mumIdPerso = $mumIdPerso;

        return $this;
    }

    public function getMumIdExt(): ?int
    {
        return $this->mumIdExt;
    }

    public function setMumIdExt(int $mumIdExt): self
    {
        $this->mumIdExt = $mumIdExt;

        return $this;
    }


}
