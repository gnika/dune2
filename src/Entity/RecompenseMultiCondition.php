<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RecompenseMultiCondition
 *
 * @ORM\Table(name="recompense_multi_condition")
 * @ORM\Entity
 */
class RecompenseMultiCondition
{
    /**
     * @var int
     *
     * @ORM\Column(name="remc_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $remcId;

    /**
     * @var int
     *
     * @ORM\Column(name="remc_id_lien", type="integer", nullable=false)
     */
    private $remcIdLien;

    /**
     * @var int
     *
     * @ORM\Column(name="remc_id_quete", type="integer", nullable=false)
     */
    private $remcIdQuete;

    /**
     * @var int
     *
     * @ORM\Column(name="remc_id_perso", type="integer", nullable=false)
     */
    private $remcIdPerso;

    /**
     * @var int
     *
     * @ORM\Column(name="remc_id_ext", type="integer", nullable=false)
     */
    private $remcIdExt;

    public function getRemcId(): ?int
    {
        return $this->remcId;
    }

    public function getRemcIdLien(): ?int
    {
        return $this->remcIdLien;
    }

    public function setRemcIdLien(int $remcIdLien): self
    {
        $this->remcIdLien = $remcIdLien;

        return $this;
    }

    public function getRemcIdQuete(): ?int
    {
        return $this->remcIdQuete;
    }

    public function setRemcIdQuete(int $remcIdQuete): self
    {
        $this->remcIdQuete = $remcIdQuete;

        return $this;
    }

    public function getRemcIdPerso(): ?int
    {
        return $this->remcIdPerso;
    }

    public function setRemcIdPerso(int $remcIdPerso): self
    {
        $this->remcIdPerso = $remcIdPerso;

        return $this;
    }

    public function getRemcIdExt(): ?int
    {
        return $this->remcIdExt;
    }

    public function setRemcIdExt(int $remcIdExt): self
    {
        $this->remcIdExt = $remcIdExt;

        return $this;
    }


}
