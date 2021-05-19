<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Objet
 *
 * @ORM\Table(name="objet")
 * @ORM\Entity
 */
class Objet
{
    /**
     * @var int
     *
     * @ORM\Column(name="obj_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $objId;

    /**
     * @var string
     *
     * @ORM\Column(name="obj_commentaire", type="string", length=255, nullable=false)
     */
    private $objCommentaire;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="obj_nom", type="string", length=255, nullable=false)
     */
    private $objNom;

    /**
     * @var string
     *
     * @ORM\Column(name="obj_image", type="string", length=255, nullable=false)
     */
    private $objImage;

    /**
     * @var string
     *
     * @ORM\Column(name="obj_dbl", type="text", length=65535, nullable=false)
     */
    private $objDbl;

    public function getObjId(): ?int
    {
        return $this->objId;
    }

    public function getObjCommentaire(): ?string
    {
        return $this->objCommentaire;
    }

    public function setObjCommentaire(string $objCommentaire): self
    {
        $this->objCommentaire = $objCommentaire;

        return $this;
    }

    public function getObjNom(): ?string
    {
        return $this->objNom;
    }

    public function setObjNom(string $objNom): self
    {
        $this->objNom = $objNom;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }



    public function getObjImage(): ?string
    {
        return $this->objImage;
    }

    public function setObjImage(string $objImage): self
    {
        $this->objImage = $objImage;

        return $this;
    }

    public function getObjDbl(): ?string
    {
        return $this->objDbl;
    }

    public function setObjDbl(string $objDbl): self
    {
        $this->objDbl = $objDbl;

        return $this;
    }


}
