<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArretRecompense
 *
 * @ORM\Table(name="arret_recompense")
 * @ORM\Entity
 */
class ArretRecompense
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
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     */
    private $idUser;

    /**
     * @var int
     *
     * @ORM\Column(name="rec_id", type="integer", nullable=false)
     */
    private $recId;

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
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->idUser;
    }

    /**
     * @param int $idUser
     */
    public function setIdUser(int $idUser): void
    {
        $this->idUser = $idUser;
    }

    /**
     * @return int
     */
    public function getRecId(): int
    {
        return $this->recId;
    }

    /**
     * @param int $recId
     */
    public function setRecId(int $recId): void
    {
        $this->recId = $recId;
    }






}
