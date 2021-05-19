<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Influence
 *
 * @ORM\Table(name="influence")
 * @ORM\Entity
 */
class Influence
{
    /**
     * @var int
     *
     * @ORM\Column(name="inf_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $infId;

    /**
     * @var int
     *
     * @ORM\Column(name="inf_id_user", type="integer", nullable=false)
     */
    private $infIdUser;

    /**
     * @var int
     *
     * @ORM\Column(name="inf_id_faction", type="integer", nullable=false)
     */
    private $infIdFaction;

    /**
     * @var int
     *
     * @ORM\Column(name="inf_nb_influence", type="integer", nullable=false)
     */
    private $infNbInfluence;

    public function getInfId(): ?int
    {
        return $this->infId;
    }

    public function getInfIdUser(): ?int
    {
        return $this->infIdUser;
    }

    public function setInfIdUser(int $infIdUser): self
    {
        $this->infIdUser = $infIdUser;

        return $this;
    }

    public function getInfIdFaction(): ?int
    {
        return $this->infIdFaction;
    }

    public function setInfIdFaction(int $infIdFaction): self
    {
        $this->infIdFaction = $infIdFaction;

        return $this;
    }

    public function getInfNbInfluence(): ?int
    {
        return $this->infNbInfluence;
    }

    public function setInfNbInfluence(int $infNbInfluence): self
    {
        $this->infNbInfluence = $infNbInfluence;

        return $this;
    }


}
