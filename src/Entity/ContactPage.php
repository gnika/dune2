<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContactPage
 *
 * @ORM\Table(name="contact_page")
 * @ORM\Entity
 */
class ContactPage
{
    /**
     * @var int
     *
     * @ORM\Column(name="cp_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cpId;

    /**
     * @var string
     *
     * @ORM\Column(name="cp_headtitle", type="string", length=250, nullable=false)
     */
    private $cpHeadtitle;

    /**
     * @var string
     *
     * @ORM\Column(name="cp_title", type="string", length=250, nullable=false)
     */
    private $cpTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="cp_description", type="text", length=65535, nullable=false)
     */
    private $cpDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="cp_keywords", type="text", length=65535, nullable=false)
     */
    private $cpKeywords;

    /**
     * @var string
     *
     * @ORM\Column(name="cp_content", type="text", length=65535, nullable=false)
     */
    private $cpContent;

    public function getCpId(): ?int
    {
        return $this->cpId;
    }

    public function getCpHeadtitle(): ?string
    {
        return $this->cpHeadtitle;
    }

    public function setCpHeadtitle(string $cpHeadtitle): self
    {
        $this->cpHeadtitle = $cpHeadtitle;

        return $this;
    }

    public function getCpTitle(): ?string
    {
        return $this->cpTitle;
    }

    public function setCpTitle(string $cpTitle): self
    {
        $this->cpTitle = $cpTitle;

        return $this;
    }

    public function getCpDescription(): ?string
    {
        return $this->cpDescription;
    }

    public function setCpDescription(string $cpDescription): self
    {
        $this->cpDescription = $cpDescription;

        return $this;
    }

    public function getCpKeywords(): ?string
    {
        return $this->cpKeywords;
    }

    public function setCpKeywords(string $cpKeywords): self
    {
        $this->cpKeywords = $cpKeywords;

        return $this;
    }

    public function getCpContent(): ?string
    {
        return $this->cpContent;
    }

    public function setCpContent(string $cpContent): self
    {
        $this->cpContent = $cpContent;

        return $this;
    }


}
