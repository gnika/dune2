<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MultiCondition
 *
 * @ORM\Table(name="multi_condition")
 * @ORM\Entity
 */
class MultiCondition
{
    /**
     * @var int
     *
     * @ORM\Column(name="mu_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $muId;

    /**
     * @var int
     *
     * @ORM\Column(name="mu_id_lien", type="integer", nullable=false)
     */
    private $muIdLien;

    /**
     * @var int
     *
     * @ORM\Column(name="mu_id_quete", type="integer", nullable=false)
     */
    private $muIdQuete;

    /**
     * @var int
     *
     * @ORM\Column(name="mu_id_perso", type="integer", nullable=false)
     */
    private $muIdPerso;

    /**
     * @var int
     *
     * @ORM\Column(name="mu_id_ext", type="integer", nullable=false)
     */
    private $muIdExt;

    public function getMuId(): ?int
    {
        return $this->muId;
    }

    public function getMuIdLien(): ?int
    {
        return $this->muIdLien;
    }

    public function setMuIdLien(int $muIdLien): self
    {
        $this->muIdLien = $muIdLien;

        return $this;
    }

    public function getMuIdQuete(): ?int
    {
        return $this->muIdQuete;
    }

    public function setMuIdQuete(int $muIdQuete): self
    {
        $this->muIdQuete = $muIdQuete;

        return $this;
    }

    public function getMuIdPerso(): ?int
    {
        return $this->muIdPerso;
    }

    public function setMuIdPerso(int $muIdPerso): self
    {
        $this->muIdPerso = $muIdPerso;

        return $this;
    }

    public function getMuIdExt(): ?int
    {
        return $this->muIdExt;
    }

    public function setMuIdExt(int $muIdExt): self
    {
        $this->muIdExt = $muIdExt;

        return $this;
    }


}
